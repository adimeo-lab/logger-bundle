<?php

namespace Adimeo\Logger\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class UserNotification
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="entity_logs")
 */
class Log
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
     * @ORM\Column(type="string", nullable=true, name="userId")
     *
     * @Groups({"logger"})
     */
    protected $user;

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
    public function __construct(?string $user, array $content)
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
     * @return Log
     */
    public function setId(string $id): Log
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @param string $user
     * @return Log
     */
    public function setUser(string $user): Log
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
     * @return Log
     */
    public function setEntity(string $entity): Log
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
     * @return Log
     */
    public function setEntityId(string $entityId): Log
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
     * @return Log
     */
    public function setEvent(int $event): Log
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
     * @return Log
     */
    public function setContent(array $content): Log
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
     * @return Log
     */
    public function setDate(\DateTime $date): Log
    {
        $this->date = $date;
        return $this;
    }
}
