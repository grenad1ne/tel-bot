<?php

/*
* This file is part of GeeksWeb Bot (GWB).
*
* GeeksWeb Bot (GWB) is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License version 3
* as published by the Free Software Foundation.
* 
* GeeksWeb Bot (GWB) is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.  <http://www.gnu.org/licenses/>
*
* Author(s):
*
* © 2015-2018 Kasra Madadipouya <kasra@madadipouya.com>
*
*/
require 'vendor/autoload.php';

$client = new Zelenin\Telegram\Bot\Api('1706737657:AAGwdAYlMkxPqm6p_48eKcNlqugBLVswDsI'); // Set your access token
$url = 'https://excuse-telegram-bot.herokuapp.com'; // URL RSS feed
$update = json_decode(file_get_contents('php://input'));
$reasons = file('./reasons.txt');

//your app
try {
    $text = $update->message->text;

    if ($text && stripos($text, '/add-reason') === false) {
        $rand_key = array_rand($reasons, 1);
        $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
        $response = $client->sendMessage(
            [
                'chat_id' => $update->message->chat->id,
                'text' => "Друзья, простите. Причина моего проеба: " . $reasons[$rand_key],
            ]
        );
    }

    if (stripos($text, '/add-reason')) {
//        print_r(stripos($text, '/add-reason'));
//
//        $reasonText = substr($text, stripos($text, '/add-reason'));
//        print_r($reasonText);
//
//        $fp = fopen('./reasons.txt', 'a+');
//        fwrite($fp, $reasonText . PHP_EOL);
//        fclose($fp);

        $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
        $response = $client->sendMessage(
            [
                'chat_id' => $update->message->chat->id,
                'text' => "Опа, новая отмазочка для Олега",
            ]
        );
    }
} catch (\Zelenin\Telegram\Bot\NotOkException $e) {
    //echo error message ot log it
    //echo $e->getMessage();

}
