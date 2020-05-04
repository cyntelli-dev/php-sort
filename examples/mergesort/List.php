<?php

require __DIR__ . '/../../vendor/autoload.php';

use Cyntelli\Sort\MergeSort;

$data = (new MergeSort)->executeList([1792, 2846, 3891, 2894, 3089, 1112, 3670, 891, 2233, 1800]);
// $data = (new MergeSort)->executeList([1792, 2846, 3891, 2894, 3089, 1112, 3670, 891, 2233, 1800], 'DESC');

var_dump($data);
exit;