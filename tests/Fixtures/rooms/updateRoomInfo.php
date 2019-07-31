<?php

$roomId = 100;

$params = [
    'description' => 'group chat description',
    'icon_preset' => 'meeting',
    'name' => 'Website renewal project',
];

$updateRoom = [ "roomId" => 1234];

return [
    'roomId' => $roomId,
    'params' => $params,
    'updateRoom' => $updateRoom,
];
