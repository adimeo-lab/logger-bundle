<?php

namespace Adimeo\Logger\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

/**
 * Class LogIndexer
 * @package Adimeo\Logger\EventListener
 */
class LogIndexer implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return [
            Events::postPersist,
            Events::postRemove,
            Events::postUpdate,
        ];
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        dd($args);
    }

    public function postRemove(LifecycleEventArgs $args): void
    {
    }

    public function postUpdate(LifecycleEventArgs $args): void
    {
    }
}