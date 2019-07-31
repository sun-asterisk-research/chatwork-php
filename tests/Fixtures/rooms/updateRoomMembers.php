<?php
$roomId = 123;

$membersAdminIds = [123, 542, 1001];

$params = [
    'members_member_ids' => [21, 344],
    'members_readonly_ids' => [15, 103],
];

$params1 = [
    "members_member_ids" => "21,344",
    "members_readonly_ids" => "15,103",
    "members_admin_ids" => "123,542,1001",
];

$update = [
    "admin" => [123, 542, 1001],
    "member" => [10, 103],
    "readonly" => [6, 11],
];

return [
    "roomId" => $roomId,
    "membersAdminIds" => $membersAdminIds,
    "params" => $params,
    "update" => $update,
    "params1" => $params1,
];
