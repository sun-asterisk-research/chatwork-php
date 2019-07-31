<?php
$requestId = 100;


$incomingrequest = [
    [
        "request_id"=> 123,
        "account_id"=> 363,
        "message"=> "hogehoge",
        "name"=> "John Smith",
        "chatwork_id"=> "tarochatworkid",
        "organization_id"=> 101,
        "organization_name"=> "Hello Company",
        "department"=> "Marketing",
        "avatar_image_url"=> "https=>//example.com/abc.png",
    ],
];


$acceptcontact = [
  "account_id"=> 363,
  "roomId"=> 1234,
  "name"=> "John Smith",
  "chatwork_id"=> "tarochatworkid",
  "organization_id"=> 101,
  "organization_name"=> "Hello Company",
  "department"=> "Marketing",
  "avatar_image_url"=> "https=>//example.com/abc.png",
];

$rejectcontact = [];

return [
    'requestId' => $requestId,
    'incomingrequests' => $incomingrequest,
    'accepcontact' => $acceptcontact,
    'rejectcontact' => $rejectcontact,
];
