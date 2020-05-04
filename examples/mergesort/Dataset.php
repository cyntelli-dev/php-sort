<?php

require __DIR__ . '/../../vendor/autoload.php';

use Cyntelli\Sort\MergeSort;

$dataset = [
    [
        'account_id' => '1',
        'clicks' => 48,
        'impressions' => 1792
    ],
    [
        'account_id' => '2',
        'clicks' => 90,
        'impressions' => 2846
    ],
    [
        'account_id' => '3',
        'clicks' => 99,
        'impressions' => 3891
    ],
    [
        'account_id' => '4',
        'clicks' => 138,
        'impressions' => 2894
    ],
    [
        'account_id' => '5',
        'clicks' => 61,
        'impressions' => 3089
    ],
    [
        'account_id' => '6',
        'clicks' => 74,
        'impressions' => 1112
    ],
    [
        'account_id' => '7',
        'clicks' => 101,
        'impressions' => 3670
    ],
    [
        'account_id' => '8',
        'clicks' => 5,
        'impressions' => 891
    ],
    [
        'account_id' => '9',
        'clicks' => 78,
        'impressions' => 2233
    ],
    [
        'account_id' => '10',
        'clicks' => 28,
        'impressions' => 1800
    ]
];

$data = (new MergeSort)->executeDataset($dataset, 'impressions');
// $data = (new MergeSort)->executeDataset($dataset, 'impressions', 'DESC');

var_dump($data);
exit;