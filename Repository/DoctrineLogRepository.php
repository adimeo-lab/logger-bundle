<?php

namespace Adimeo\Logger\Repository;

use Adimeo\Logger\Entity\AbstractDoctrineLog;
use Adimeo\Logger\Entity\AbstractLog;
use Adimeo\Logger\Entity\Log;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Class DoctrineLogRepository
 * @package Adimeo\Logger\Repository
 */
class DoctrineLogRepository extends ServiceEntityRepository implements LogRepositoryInterface
{
    /** @var EntityManagerInterface  */

    /**
     * DoctrineLogRepository constructor.
     */
    public function __construct(ManagerRegistry $registry, string $class)
    {
        parent::__construct($registry, $class);
    }

    /**
     * @param AbstractDoctrineLog $log
     */
    public function create($log)
    {
        $this->_em->persist($log);

        $classMetadata = $this->_em->getClassMetadata(get_class($log));
        $this->_em->getUnitOfWork()->computeChangeSet($classMetadata, $log);
    }

    public function fetch(int $page = 1, int $limit = 50, array $filters = [])
    {
        $queryBuilder = $this
            ->createQueryBuilder('l');

        $queryBuilder->orderBy('l.date', 'DESC');

        $paginator = new Paginator($queryBuilder);

        return $paginator;
    }
}