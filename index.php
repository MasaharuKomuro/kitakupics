<?php

require_once __DIR__ . '/vendor/autoload.php';

use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

//$channel_access_token = "CEfOrjUN6d+U7epHX+ACz6KDfvbWErafwVUlS/cAHT1u/ZROZebCsy8OO99Ih7KAlq9EDr0T0ggOK6DsK/0vxRq+5o3rnW/6p14RTMabnfAGg+poSChoz8Mmb/UZKaoquX6C6dg8/U/4JRE4uitAnwdB04t89/1O/w1cDnyilFU=";
//$channel_secret = "90a98f5c73da5c01de4c982eca67c7f6";
//
//echo "test1\n";
//$httpClient = new CurlHTTPClient( $channel_access_token );
//echo "test1.1\n";
//$bot = new LINEBot($httpClient, ['channelSecret' => $channel_secret ]);
//
//echo "test1.5\n";
//$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
//echo "test1.6\n";
//
//$body = file_get_contents("php://input");
//$signature = $_SERVER["HTTP_".\LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
//$events = $bot->parseEventRequest($body, $signature);
////echo "event".$event;
//$reply_token = "";
//foreach ($events as $event) {
//    if ($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage) {
//        $reply_token = $event->getReplyToken();
////        $mid = $event["source"]["userId"];
//        $text = $event->getText();
//        $bot->replyText($reply_token, $text.":");
//    }
//}
//$response = $bot->replyMessage( $reply_token, $textMessageBuilder);
//echo "test.1.7\n";
//print $response->getHTTPStatus() . ' ' . $response->getRawBody();
//
//
//echo "<br>OK";

new LineMessage;

class LineMessage{

    private $token = '[Channel Access Token]';
    private $secret = '[Channel Secret]';
    private $profile_array = array(); //プロフィールを格納する配列 displayName:表示名 userId:ユーザ識別子 pictureUrl:画像URL statusMessage:ステータスメッセージ

    private $replyToken;
    private $userId;
    private $httpClient;
    private $bot;

    function __construct(){

        $json_string = file_get_contents('php://input');
        $jsonObj = json_decode($json_string);
        $this->userId = $jsonObj->{"events"}[0]->{"source"}->{"userId"};
        $this->replyToken = $jsonObj->{"events"}[0]->{"replyToken"};

        $this->httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($this->token);
        $this->bot = new \LINE\LINEBot($this->httpClient, ['channelSecret' => $this->secret]);

        $this->get_profile();

    }

    function get_profile(){

        $response = $this->bot->getProfile($this->userId);

        if ($response->isSucceeded()) {

            $profile = $response->getJSONDecodedBody();
            $displayName = $profile['displayName'];
            $userId = $profile['userId'];
            $pictureUrl = $profile['pictureUrl'];
            $statusMessage = $profile['statusMessage'];
            $this->profile_array = array("displayName"=>$displayName,"userId"=>$userId,"pictureUrl"=>$pictureUrl,"statusMessage"=>$statusMessage);
            $this->reply_message();
        }
    }

    function reply_message(){

        $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($this->profile_array["displayName"]."さんこんにちは！");
        $response = $this->bot->replyMessage($this->replyToken, $textMessageBuilder);
    }

}
