<?php

namespace Adimeo\Logger\Entity;

/**
 * Interface LogInterface
 * @package Adimeo\Logger\Entity
 */
interface LogInterface
{
    /**
     * @return array
     */
    public static function getFqcnLabels(): array;

    /**
     * @return string
     */
    public static function getTargetedEntity(): string;
}