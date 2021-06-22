<?php

namespace Adimeo\Logger\Repository;

use Adimeo\Logger\Entity\AbstractElsLog;
use Adimeo\Logger\Entity\Log;
use App\Client\AbstractElasticClient;
use App\Elasticsearch\CustomSmartSerializer;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeZoneNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ElsLogRepository implements LogRepositoryInterface
{
    /** @var string  */
    protected $index;

    /** @var  */
    protected $client;

    /** @var string  */
    protected $class;

    /** @var Serializer */
    protected $serializer;

    /** @var array */
    protected $query;

    /**
     * ElsLogRepository constructor.
     * @param string $elasticHosts
     * @param string $index
     */
    public function __construct(string $elasticHosts, string $index, string $class)
    {
        $this->index = $index;
        $this->class = $class;

        $this->client = ClientBuilder::create()
            ->setHosts(explode(';', $elasticHosts))
            ->build();

        $normalizers = [new DateTimeNormalizer(), new ObjectNormalizer()];
        $serializer = new Serializer($normalizers);

        $this->serializer = $serializer;
    }

    /**
     * @return array
     */
    public function createIndex(array $mapping)
    {
        return $this->client
            ->indices()
            ->create(['index' => $this->index, 'body' => $mapping]);
    }

    /**
     * @param string $param
     * @param        $value
     * @param bool   $override
     *
     * @return $this
     */
    public function addQueryParam(
        string $param,
        $value,
        bool $override = true
    ): self {
        if (
            true === $override ||
            (false === $override && !isset($this->query[$param]))
        ) {
            $this->query[$param] = $value;
        }

        return $this;
    }

    /**
     * @param array $query
     */
    public function setQuery(array $query): void
    {
        $this->query = $query;
    }

    /**
     * @return array
     */
    public function getQuery(): array
    {
        return $this->query;
    }


    /**
     * @param $log
     */
    public function create($log)
    {
        try {
            $mapping = $log->getMapping();
            $this->createIndex($mapping);
        } catch (\Throwable $exception) {
            // Already created
        }

        // Generate id
        $id = Uuid::uuid4()->toString();

        $log->setId($id);

        $entity = $this->serializer->normalize($log);
        unset($entity['mapping']);

        $params['body'][] = [
            'index' => [
                '_index' => $this->index,
                '_id' => $id,
            ],
        ];
        $params['body'][] = $entity;

        $this->client->bulk($params);
    }

    public function fetch(int $page = 1, int $limit = 50, array $filters = [])
    {
        $this->addQueryParam('index', $this->index);
        $this->addQueryParam('from', $page - 1);
        $this->addQueryParam('size', $limit);

        $response = $this->client->search($this->query);

        $total = $response['hits']['total']['value'] ?? 0;

        $return = [];
        foreach ($response['hits']['hits'] as $item) {
            $log = $this->serializer->denormalize($item['_source'], $this->class);
            $return[] = $log;
        }

        return $return;
    }
}