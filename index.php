<?php

require 'vendor/autoload.php';

use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;

$telegram = new Api('1706737657:AAGwdAYlMkxPqm6p_48eKcNlqugBLVswDsI');
$url = 'https://excuse-telegram-bot.herokuapp.com'; // URL RSS feed

$result = $telegram->getWebhookUpdates();

$text = $result["message"]["text"]; //Текст сообщения
$chat_id = $result["message"]["chat"]["id"]; //Уникальный идентификатор пользователя
$name = $result["message"]["from"]["username"]; //Юзернейм пользователя
$keyboard = [["Срочно нужна причина для отмазки"]]; //Клавиатура
$reasons = [
    'Леха сломал',
    'Сплю еще',
    'Потерялся',
];

if ($text) {
    if ($text === "/start") {
        $reply = "Меня зовут Олег и опять решил проебаться";
        $reply_markup = Keyboard::make(
            ['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]
        );
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
    } elseif ($text === "Срочно нужна причина для отмазки") {
        $reply = "Причина для отмазыча";
        $telegram->sendMessage(['chat_id' => $chat_id, 'parse_mode' => 'HTML', 'text' => $reply]);
    } else {
        $reply = "Тупо тыкай кнопку. Здесь нет дополнительного функционала";
        $telegram->sendMessage(['chat_id' => $chat_id, 'parse_mode' => 'HTML', 'text' => $reply]);
    }
} else {
    $telegram->sendMessage(['chat_id' => $chat_id, 'text' => "Отправьте текстовое сообщение."]);
}
