<?php

namespace Adimeo\Logger\Repository;

use Adimeo\Logger\Entity\Log;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class DoctrineLogRepository
 * @package Adimeo\Logger\Repository
 */
class DoctrineLogRepository implements LogRepository
{
    /** @var EntityManagerInterface  */
    protected $em;

    /**
     * DoctrineLogRepository constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param Log $log
     */
    public function create(Log $log)
    {
        $this->em->persist($log);

        $classMetadata = $this->em->getClassMetadata(Log::class);
        $this->em->getUnitOfWork()->computeChangeSet($classMetadata, $log);
    }

    public function fetch(int $page, array $filters)
    {
        // TODO: Implement fetch() method.
    }
}