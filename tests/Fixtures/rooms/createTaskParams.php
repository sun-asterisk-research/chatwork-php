<?php

$to_ids = [1, 3, 6];
$to_ids_string = '1,3,6';
$params = [
    [
        'body' => 'Buy_milk',
        'to_ids' => $to_ids_string,
    ],
    [
        'body' => 'Buy milk',
        'to_ids' => $to_ids_string,
        'limit' => 13456778,
    ],
];

return [
    'to_ids' => $to_ids,
    'params' => $params,
];
