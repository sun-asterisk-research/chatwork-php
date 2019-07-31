<?php

$status = [
    "unread_room_num" => 2,
    "mention_room_num" => 1,
    "mytask_room_num" => 3,
    "unread_num" => 12,
    "mention_num" => 1,
    "mytask_num" => 8,
];

$tasks = [
    [
        "task_id" => 3,
        "room" => [
            "room_id" => 5,
            "name" => "Group Chat Name",
            "icon_path" => "https=>//example.com/ico_group.png",
        ],
        "assigned_by_account" => [
            "account_id" => 456,
            "name" => "Anna",
            "avatar_image_url" => "https=>//example.com/def.png",
        ],
        "message_id" => "13",
        "body" => "buy milk",
        "limit_time" => 1384354799,
        "status" => "open",
    ],
];

return [
    "status" => $status,
    "tasks" => $tasks,
];
