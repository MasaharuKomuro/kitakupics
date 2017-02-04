<?php

use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

define("LINE_MESSAGING_API_CHANNEL_SECRET", '90a98f5c73da5c01de4c982eca67c7f6');
define("LINE_MESSAGING_API_CHANNEL_TOKEN", 'WK5cvAPfggMr7zvLgWkVlbrhzPUOFVlSNY/6fOmeY4I3BLVADi68/2X4N5YdV2Golq9EDr0T0ggOK6DsK/0vxRq+5o3rnW/6p14RTMabnfCuMbnzUwqi7Tvng3uvjKhbyN159MD21rH99cPtAocbrgdB04t89/1O/w1cDnyilFU=');

require __DIR__."/../vendor/autoload.php";

$bot = new \LINE\LINEBot(
    new \LINE\LINEBot\HTTPClient\CurlHTTPClient(LINE_MESSAGING_API_CHANNEL_TOKEN),
    ['channelSecret' => LINE_MESSAGING_API_CHANNEL_SECRET]
);

$signature = $_SERVER["HTTP_".\LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
$body = file_get_contents("php://input");

$events = $bot->parseEventRequest($body, $signature);

foreach ($events as $event) {
    if ($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage) {
        $reply_token = $event->getReplyToken();
        $text = $event->getText();
        $bot->replyText($reply_token, $text);
    }
}

echo "OK";
