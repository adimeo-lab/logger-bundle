<?php

namespace Adimeo\Logger\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class DoctrineLog
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="entity_logs")
 */
class DoctrineLog extends AbstractDoctrineLog
{
}