<?php

require_once __DIR__ . '/vendor/autoload.php';

use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

$channel_access_token = "CEfOrjUN6d+U7epHX+ACz6KDfvbWErafwVUlS/cAHT1u/ZROZebCsy8OO99Ih7KAlq9EDr0T0ggOK6DsK/0vxRq+5o3rnW/6p14RTMabnfAGg+poSChoz8Mmb/UZKaoquX6C6dg8/U/4JRE4uitAnwdB04t89/1O/w1cDnyilFU=";
$channel_secret = "90a98f5c73da5c01de4c982eca67c7f6";

echo "test1\n";
$httpClient = new CurlHTTPClient( $channel_access_token );
echo "test1.1\n";
$bot = new LINEBot($httpClient, ['channelSecret' => $channel_secret ]);
 
echo "test1.5\n";
$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
echo "test1.6\n";
$input = file_get_contents('php://input');
$json = json_decode($input);
$event = $json->events[0];
echo "event".$event;
$response = $bot->replyMessage('{replyToken}', $textMessageBuilder);
echo "test.1.7\n";
echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
echo "<br>test2\n";
