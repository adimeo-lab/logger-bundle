<?php

namespace Adimeo\Logger\Entity;

/**
 * Class AbstractLog
 * @package Adimeo\Logger\Entity
 */
abstract class AbstractLog
{
    const EVENT_CREATION = 1;
    const EVENT_EDITION  = 2;
    const EVENT_DELETION = 3;

    /**
     * @var string
     */
    protected string $id;

    /**
     * @var string $userId
     */
    protected $userId;

    /**
     * @var string $entity
     */
    protected string $entity;

    /**
     * @var string $entityId
     */
    protected string $entityId;

    /**
     * @var int $type
     */
    protected int $event;

    /**
     * @var array
     */
    protected array $content;

    /**
     * @var string $date
     */
    protected $date;

    /**
     * AbstractLog constructor.
     */
    public function __construct(?string $userId, array $content)
    {
        $this->date = new \DateTime();
        $this->$userId = $userId;
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return AbstractLog
     */
    public function setId(string $id): AbstractLog
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserId(): ?string
    {
        return $this->userId;
    }

    /**
     * @param string $user
     * @return AbstractLog
     */
    public function setUserId(?string $user): AbstractLog
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return string
     */
    public function getEntity(): string
    {
        return $this->entity;
    }

    /**
     * @param string $entity
     * @return AbstractLog
     */
    public function setEntity(string $entity): AbstractLog
    {
        $this->entity = $entity;
        return $this;
    }

    /**
     * @return string
     */
    public function getEntityId(): string
    {
        return $this->entityId;
    }

    /**
     * @param string $entityId
     * @return AbstractLog
     */
    public function setEntityId(string $entityId): AbstractLog
    {
        $this->entityId = $entityId;
        return $this;
    }

    /**
     * @return int
     */
    public function getEvent(): int
    {
        return $this->event;
    }

    /**
     * @param int $event
     * @return AbstractLog
     */
    public function setEvent(int $event): AbstractLog
    {
        $this->event = $event;
        return $this;
    }

    /**
     * @return array
     */
    public function getContent(): array
    {
        return $this->content;
    }

    /**
     * @param array $content
     * @return AbstractLog
     */
    public function setContent(array $content): AbstractLog
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return AbstractLog
     */
    public function setDate($date): AbstractLog
    {
        $this->date = $date;
        return $this;
    }
}