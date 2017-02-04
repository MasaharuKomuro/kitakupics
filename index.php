<?php

namespace LINE\LINEBot\KitchenSink;

use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

$channel_access_token = "	
Long term token which is displayed permanently.7/ubzHaveXYa4q+Q2TwlwrnmMbTt0FUSWWOV5jctpqIgwaSgUTytg3MrRVsoF+c3lq9EDr0T0ggOK6DsK/0vxRq+5o3rnW/6p14RTMabnfC3LeuMeKzNDeT5DbDKGit960o/0L4nc/B4OE0W/euzJAdB04t89/1O/w1cDnyilFU=";
$channel_secret = "90a98f5c73da5c01de4c982eca67c7f6";

echo "test1";
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient( $channel_access_token );
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channel_secret ]);
 
echo "test1.5";
$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
echo "test1.6";
$response = $bot->replyMessage('{replyToken}', $textMessageBuilder);
 
echo $response->getHTTPStatus() . ' ' . $response->getBody();
echo "<br>test2";
