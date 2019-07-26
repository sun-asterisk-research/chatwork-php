<?php
$name = "Test create a room";

$members_admin_ids = [123, 542, 1001];

$params = [
    "description" => "group chat description",
    "icon_preset" => "document",
    "members_member_ids" => [21, 344],
    "members_readonly_ids" => [15, 103],
];

$newRoom = ["roomId" => 1234];

$params1 = [
    "description" => "group chat description",
    "icon_preset" => "document",
    "members_member_ids" => "21,344",
    "members_readonly_ids" => "15,103",
    "members_admin_ids" => "123,542,1001",
    "name" => "Test create a room",
];

return [
    "name" => $name,
    "membersAdminIds" => $members_admin_ids,
    "params" => $params,
    "newRoom" => $newRoom,
    "params1" => $params1,
];
