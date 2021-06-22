<?php

namespace Adimeo\Logger\Entity;

interface ElsLogInterface extends LogInterface
{
    public function getMapping(): array;
}