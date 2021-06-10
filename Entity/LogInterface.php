<?php

namespace Adimeo\Notifications\Entity;

/**
 * Interface LogInterface
 * @package Adimeo\Notifications\Entity
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