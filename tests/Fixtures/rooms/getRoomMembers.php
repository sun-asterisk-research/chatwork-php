<?php

$roomId = 100;

$room_members = [
    [   "account_id"=> 123,
        "role"=> "member",
        "name"=> "John Smith",
        "chatwork_id"=> "tarochatworkid",
        "organization_id"=> 101,
        "organization_name"=> "Hello Company",
        "department"=> "Marketing",
        "avatar_image_url"=> "https=>//example.com/abc.png",
    ],
    [
        "account_id"=> 456,
        "role"=> "member",
        "name"=> "Recica John",
        "chatwork_id"=> "tarochatworkid",
        "organization_id"=> 101,
        "organization_name"=> "Hello Company",
        "department"=> "R&D",
        "avatar_image_url"=> "https=>//example.com/def.png",
    ],
];

return [
    'roomId' => $roomId,
    'roomMembers' => $room_members,
];
