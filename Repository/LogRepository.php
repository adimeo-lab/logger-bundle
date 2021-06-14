<?php

namespace Adimeo\Logger\Repository;

use Adimeo\Logger\Entity\Log;

interface LogRepository
{
    public function create(Log $log);

    public function fetch(int $page, array $filters);
}