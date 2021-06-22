<?php

namespace Adimeo\Logger\Entity;

/**
 * Class AbstractElsLog
 * @package Adimeo\Logger\Entity
 */
class AbstractElsLog extends AbstractLog implements ElsLogInterface
{
    public function getMapping(): array
    {
        return [
            'settings' => [
                'max_result_window' => 10000000,
                'analysis' => [
                    'filter' => [
                        'my_ascii_folding' =>
                            [
                                'type' => 'asciifolding',
                                'preserve_original' => true,
                            ],
                    ],
                    'analyzer' => [
                        'custom_analyzer' =>
                            [
                                'type' => 'custom',
                                'tokenizer' => 'standard',
                                'filter' => ['lowercase', 'my_ascii_folding'],
                            ],
                    ],
                    'normalizer' => [
                        'keyword_normalizer' => [
                            'type' => 'custom',
                            'char_filter' => [],
                            'filter' => ['lowercase', 'my_ascii_folding'],
                        ],
                    ],
                ],
            ],
            'mappings' => [
                'properties' => [
                    'id' => ['type' => 'text',],
                    'userId' => ['type' => 'text',],
                    'entity' => ['type' => 'text',],
                    'entityId' => ['type' => 'text',],
                    'event' => ['type' => 'keyword',],
                    'content' => ['type' => 'nested',],
                    'date' => [
                        'type' => 'basic_date_time',
                    ],
                ],
            ],
        ];
    }
}