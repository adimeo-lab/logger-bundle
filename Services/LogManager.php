<?php

namespace Adimeo\Logger\Services;

use Adimeo\Logger\Entity\LogInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class NotificationManager
 * @package Adimeo\Notifications\Services
 */
class LogManager
{
    /** @var EntityManagerInterface  */
    protected $entityManager;

    /**
     * NotificationManager constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * @param LogInterface $log
     * @return LogInterface
     */
    public function create(LogInterface $log)
    {
        $this->entityManager->persist($log);
        $this->entityManager->flush();

        return $log;
    }
}
