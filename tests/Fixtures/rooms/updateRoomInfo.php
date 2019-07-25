<?php

$roomId = 100;

$params = [
    'description' => 'group chat description',
    'icon_preset' => 'meeting',
    'name' => 'Website renewal project',
];

$updateRoom = [ "room_id" => 1234];

return [
    'roomId' => $roomId,
    'params' => $params,
    'updateRoom' => $updateRoom,
];
