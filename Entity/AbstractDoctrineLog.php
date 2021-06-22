<?php

namespace Adimeo\Logger\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class AbstractDoctrineLog
 * @package Adimeo\Logger\Entity
 * @ORM\MappedSuperclass
 */
class AbstractDoctrineLog extends AbstractLog implements DoctrineLogInterface
{
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
     * @var string $userId
     *
     * @ORM\Column(type="string", nullable=true, name="userId")
     *
     * @Groups({"logger"})
     */
    protected $userId;

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
     * @var $date
     *
     * @ORM\Column(type="datetime", nullable=false)
     *
     * @Groups({"logger"})
     */
    protected $date;
}