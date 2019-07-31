<?php

$roomId = 100;

$fileId = 3;

$fileInfo = [
  "file_id"=>3,
  "account"=> [
        "account_id"=>123,
    "name"=>"Bob",
    "avatar_image_url"=> "https=>//example.com/ico_avatar.png",
  ],
  "message_id"=> "22",
  "filename"=> "README.md",
  "filesize"=> 2232,
  "upload_time"=> 1384414750,
];

return [
  'roomId' => $roomId,
  'fileId' => $fileId,
  'fileInfo' => $fileInfo,
];
