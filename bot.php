<?php

$BOT_TOKEN = "8517665282:AAH3n0CTMO-hxils83v9cjhEUbaEoNQ0hHY";
$API_URL = "https://api.telegram.org/bot$BOT_TOKEN/";

$logFile = __DIR__ . "/debug.log";

/* Save anything to debug.log */
function debugLog($data) {
    global $logFile;
    file_put_contents($logFile, "[" . date("Y-m-d H:i:s") . "] " . print_r($data, true) . "\n", FILE_APPEND);
}

/* Read Telegram input */
$update = file_get_contents("php://input");

if (!$update) {
    debugLog("No input received");
    exit;
}

debugLog($update);

$update = json_decode($update, true);

if (!isset($update["message"])) {
    debugLog("No message object");
    exit;
}

$chat_id = $update["message"]["chat"]["id"];
$text    = trim($update["message"]["text"] ?? "");
$name    = $update["message"]["from"]["first_name"] ?? "Friend";

if ($text == "/start") {
    $message = "👋 Welcome $name!\n\nThis bot is now connected successfully.\nType anything and I will reply.";
} else {
    $message = "You said:\n$text";
}

sendMessage($chat_id, $message);

/* Send Message */
function sendMessage($chat_id, $text) {
    global $API_URL;

    $url = $API_URL . "sendMessage";

    $post = [
        "chat_id" => $chat_id,
        "text" => $text
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_error($ch)) {
        debugLog("CURL Error: " . curl_error($ch));
    }

    debugLog($response);

    curl_close($ch);
}
