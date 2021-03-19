<?php

$data = file_get_contents('php://input');
$data = json_decode($data, true);

if (empty($data['message']['chat']['id'])) {
    exit();
}

define('TOKEN', '1706737657:AAGwdAYlMkxPqm6p_48eKcNlqugBLVswDsI');

// Функция вызова методов API.
function sendTelegram($method, $response)
{
    $ch = curl_init('https://api.telegram.org/bot' . TOKEN . '/' . $method);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $response);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    $res = curl_exec($ch);
    curl_close($ch);

    return $res;
}

// Ответ на текстовые сообщения.
if (!empty($data['message']['text'])) {
    $text = $data['message']['text'];

    if (mb_stripos($text, 'привет') !== false) {
        sendTelegram(
            'sendMessage',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'text' => 'Хай!'
            )
        );

        exit();
    }
}