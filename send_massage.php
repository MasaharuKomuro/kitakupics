<?php

require_once __DIR__ . '/vendor/autoload.php';

$userId = "U56e3b87ed79bc7046a7ef4a1697c3fad";

$channel_access_token = "CEfOrjUN6d+U7epHX+ACz6KDfvbWErafwVUlS/cAHT1u/ZROZebCsy8OO99Ih7KAlq9EDr0T0ggOK6DsK/0vxRq+5o3rnW/6p14RTMabnfAGg+poSChoz8Mmb/UZKaoquX6C6dg8/U/4JRE4uitAnwdB04t89/1O/w1cDnyilFU=";
$channel_secret = "90a98f5c73da5c01de4c982eca67c7f6";

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient( $channel_access_token );
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channel_secret ]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
$response = $bot->pushMessage($userId, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getBody();