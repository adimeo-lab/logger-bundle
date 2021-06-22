<?php

namespace Adimeo\Logger\Services;

use Adimeo\Logger\Entity\AbstractDoctrineLog;
use Adimeo\Logger\Entity\AbstractLog;
use Adimeo\Logger\Entity\LoggedEntity;
use Adimeo\Logger\Entity\LogInterface;
use Adimeo\Logger\Repository\DoctrineLogRepository;
use Adimeo\Logger\Repository\ElsLogRepository;
use Adimeo\Logger\Repository\LogRepository;
use Adimeo\Logger\Repository\LogRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class AbstractLogManager
 * @package Adimeo\Logger\Services
 */
abstract class AbstractLogManager implements LogManagerInterface
{
    /** @var LogRepositoryInterface */
    protected $repository;

    protected $enabledDev;

    protected $env;

    public function __construct(LogRepositoryInterface $repository, string $enabledDev, string $env)
    {
        $this->repository = $repository;
        $this->enabledDev = $enabledDev;
        $this->env        = $env;
    }

    protected function persist(AbstractLog $log)
    {
        $this->repository->create($log);
    }

    /**
     * @param int $page
     * @param int $limit
     * @param array $filters
     */
    public function fetch(int $page = 1, int $limit = 50, array $filters = [])
    {
        return $this->repository->fetch($page, $limit, $filters);
    }
}
