<?php

namespace Adimeo\Logger\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

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
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     *
     * @Groups({"logger"})
     */
    protected string $id;

    /**
     * @var string $user
     *
     * @ORM\Column(type="string", nullable=false)
     *
     * @Groups({"logger"})
     */
    protected string $user;

    /**
     * @var string $entity
     *
     * @ORM\Column(type="string", nullable=false)
     *
     * @Groups({"logger"})
     */
    protected string $entity;

    /**
     * @var string $user
     *
     * @ORM\Column(type="string", nullable=false)
     *
     * @Groups({"logger"})
     */
    protected string $entityId;

    /**
     * @var int $type
     *
     * @ORM\Column(type="integer", nullable=false, options={"default": 1})
     *
     * @Groups({"logger"})
     */
    protected int $event;

    /**
     * @var array
     *
     * @ORM\Column(type="json", nullable=false)
     *
     * @Groups({"logger"})
     */
    protected array $content;

    /**
     * @var \DateTime $date
     *
     * @ORM\Column(type="datetime", nullable=false)
     *
     * @Groups({"logger"})
     */
    protected \DateTime $date;

    /**
     * AbstractLog constructor.
     */
    public function __construct(UserInterface $user, array $content)
    {
        $this->date = new \DateTime();
        $this->user = $user;
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
    public function getUser(): UserInterface|string
    {
        return $this->user;
    }

    /**
     * @param string $user
     * @return AbstractLog
     */
    public function setUser(UserInterface|string $user): AbstractLog
    {
        $this->user = $user;
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
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return AbstractLog
     */
    public function setDate(\DateTime $date): AbstractLog
    {
        $this->date = $date;
        return $this;
    }
}