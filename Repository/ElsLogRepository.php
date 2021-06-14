<?php

namespace Adimeo\Logger\Repository;

use Adimeo\Logger\Entity\Log;
use App\Client\AbstractElasticClient;

class ElsLogRepository extends AbstractElasticClient implements LogRepository
{
    public function create(Log $log)
    {
        // TODO: Implement create() method.
    }

    public function fetch(int $page, array $filters)
    {
        // TODO: Implement fetch() method.
    }
}