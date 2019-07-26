<?php

$status = [
    "unread_room_num"=> 0,
    "mention_room_num"=> 0,
    "mytask_room_num"=> 0,
    "unread_num"=> 0,
    "mention_num"=> 0,
    "mytask_num"=> 0,
];

$tasks = [
    [
        "task_id"=> 141956416,
        "rooms"=> [
        "room_id"=> 155882911,
            "name"=> "Nguyen Tien Dat B",
            "icon_path"=> "https=>//appdata.chatwork.com/avatar/3410/3410115.rsz.png",
        ],
        "assigned_by_account"=> [
        "account_id"=> 4001712,
            "name"=> "Nguyen Tuan Vu",
            "avatar_image_url"=> "https=>//appdata.chatwork.com/avatar/3410/3410108.rsz.png",
        ],
        "message_id"=> "1205767360103882752",
        "body"=> "Example1",
        "limit_time"=> 1563950915,
        "status"=> "open",
        "limit_type"=> "date",
    ],
    [
        "task_id"=> 141956417,
        "rooms"=> [
            "room_id"=> 155882911,
            "name"=> "Nguyen Tien Dat B",
            "icon_path"=> "https=>//appdata.chatwork.com/avatar/3410/3410115.rsz.png",
        ],
        "assigned_by_account"=> [
            "account_id"=> 4001712,
            "name"=> "Nguyen Tuan Vu",
            "avatar_image_url"=> "https=>//appdata.chatwork.com/avatar/3410/3410108.rsz.png",
        ],
        "message_id"=> "1205767360103882752",
        "body"=> "Example2",
        "limit_time"=> 1563950915,
        "status"=> "open",
        "limit_type"=> "date",
    ],
];

return [
    "status" => $status,
    "tasks" => $tasks,
];
