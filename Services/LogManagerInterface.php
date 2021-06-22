<?php

namespace Adimeo\Logger\Services;

/**
 * Interface LogManagerInterface
 * @package Adimeo\Logger\Services
 */
interface LogManagerInterface
{
    public function create(object $object, ?string $userId, array $payload, int $type): void;
}