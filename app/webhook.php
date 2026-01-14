<?php

require "config.php";

$input = file_get_contents("php://input");
logg("RAW: " . $input);

$update = json_decode($input, true);
if (!$update) {
    logg("Invalid JSON");
    exit;
}

if (isset($update["message"])) {
    $chat_id = $update["message"]["chat"]["id"];
    $text = $update["message"]["text"] ?? "";

    if ($text == "/start") {
        sendMessage($chat_id, "👋 Welcome!\n\nThis bot is working.\nMore features coming soon!");
    } else {
        sendMessage($chat_id, "You said: " . $text);
    }
}

function sendMessage($chat_id, $text)
{
    $url = API_URL . "sendMessage";
    $data = [
        "chat_id" => $chat_id,
        "text" => $text
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $res = curl_exec($ch);
    curl_close($ch);

    logg("SEND: " . $res);
}
