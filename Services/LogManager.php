<?php

namespace Adimeo\Logger\Services;

use Adimeo\Logger\Entity\Log;
use Adimeo\Logger\Entity\LoggedEntity;
use Adimeo\Logger\Entity\LogInterface;
use Adimeo\Logger\Repository\DoctrineLogRepository;
use Adimeo\Logger\Repository\LogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class NotificationManager
 * @package Adimeo\Notifications\Services
 */
class LogManager
{
    /** @var LogRepository */
    protected $repository;

    /** @var bool */
    protected $enableForDev;

    /** @var  */
    protected $env;

    /**
     */
    public function __construct(
        bool $enableForDev,
        string $elsHost,
        string $elsIndex,
        string $env,
        EntityManagerInterface $entityManager
    ) {
        $this->enableForDev = $enableForDev;
        $this->env = $env;

        // Doctrine
        if (null == $elsHost) {
            $this->repository = new DoctrineLogRepository($entityManager);
        } else {
            // Is els
        }
    }

    /**
     * @param object $entity
     * @param array $payload
     * @param int $type
     */
    public function create(object $entity, array $payload, int $type): void
    {
        if ($entity instanceof LoggedEntity || ($this->enableForDev && $this->env == 'dev')) {
            $log = (new Log(null, $payload))
                ->setEvent($type)
                ->setEntityId($entity->getId())
                ->setEntity($entity::class)
            ;

            $this->repository->create($log);
        }
    }
}
