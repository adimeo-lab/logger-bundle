<?php

namespace Adimeo\Logger\Repository;

use Adimeo\Logger\Entity\AbstractLog;

/**
 * Interface LogRepositoryInterface
 * @package Adimeo\Logger\Repository
 */
interface LogRepositoryInterface
{
    public function create($log);

    public function fetch(int $page = 1, int $limit = 50, array $filters = []);
}