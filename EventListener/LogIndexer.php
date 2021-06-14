<?php

namespace Adimeo\Logger\EventListener;

use Adimeo\Logger\Entity\Log;
use Adimeo\Logger\Entity\LoggedEntity;
use Adimeo\Logger\Services\LogManager;
use App\Entity\Logger;
use App\Event\User\UserDocumentRefusedEvent;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

/**
 * Class LogIndexer
 * @package Adimeo\Logger\EventListener
 */
class LogIndexer implements EventSubscriber
{
    /** @var Security  */
    protected $security;

    /** @var LogManager */
    protected $logManager;

    /** @var EventDispatcherInterface */
    protected $dispatcher;

    /** @var bool  */
    protected $enableForDev;

    /** @var string */
    protected $elsHost;

    /** @var string */
    protected $elsIndex;

    /** @var  */
    protected $serializer;

    /**
     * LogIndexer constructor.
     * @param Security $security
     * @param LogManager $logManager
     */
    public function __construct(
        Security $security,
        LogManager $logManager,
        EventDispatcherInterface $dispatcher
    ) {
        $this->security = $security;
        $this->logManager = $logManager;
        $this->dispatcher = $dispatcher;

        $normalizers = [new DateTimeNormalizer(), new ObjectNormalizer()];
        $serializer = new Serializer($normalizers);

        $this->serializer = $serializer;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::onFlush
        ];
    }

    public function onFlush(OnFlushEventArgs $args): void
    {
        $em = $args->getEntityManager();
        $uow = $em->getUnitOfWork();

        // Inserted entities
        foreach ($uow->getScheduledEntityInsertions() as $entity) {
            $payload = $this->serializer->normalize($entity);

            $this->logManager->create($entity, $payload, Log::EVENT_CREATION);
        }

        // Updated entities
        foreach ($uow->getScheduledEntityUpdates() as $entity) {
            $payload = $uow->getEntityChangeSet($entity);

            $this->logManager->create($entity, $payload, Log::EVENT_EDITION);
        }

        foreach ($uow->getScheduledEntityDeletions() as $entity) {
            $payload = $this->serializer->normalize($entity);

            $this->logManager->create($entity, $payload, Log::EVENT_DELETION);
        }
    }
}