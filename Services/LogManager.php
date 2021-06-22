<?php

namespace Adimeo\Logger\Services;

use Adimeo\Logger\Entity\DoctrineLog;
use Adimeo\Logger\Entity\LoggedEntity;

/**
 * Class LogManager
 * @package Adimeo\Logger\Services
 */
class LogManager extends AbstractLogManager implements LogManagerInterface
{
    public function create(object $object, ?string $userId, array $payload, int $type): void
    {
        if ($object instanceof LoggedEntity || ((bool) $this->enabledDev && strtolower($this->env === 'dev'))) {
            $log = (new DoctrineLog($userId, $payload))
                ->setEvent($type)
                ->setEntityId($object->getId())
                ->setEntity($object::class)
            ;

            $this->persist($log);
        }
    }
}