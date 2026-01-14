<?php
function sendMessage($chat_id, $text, $keyboard = null) {
    $data = [
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => 'HTML'
    ];

    if ($keyboard) {
        $data['reply_markup'] = json_encode($keyboard);
    }

    file_put_contents("debug.log", "SEND Attempt → chat_id: $chat_id | text: " . substr($text, 0, 100) . "\n", FILE_APPEND);

    $url = API_URL . "sendMessage";

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($data),  // safer than raw array
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_SSL_VERIFYPEER => true,
    ]);

    $res = curl_exec($ch);
    $err = curl_error($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($res === false) {
        file_put_contents("debug.log", "cURL ERROR: $err\n", FILE_APPEND);
        return false;
    }

    file_put_contents("debug.log", "SEND Response (HTTP $http_code): $res\n", FILE_APPEND);

    $response = json_decode($res, true);
    if (isset($response['ok']) && !$response['ok']) {
        file_put_contents("debug.log", "Telegram API ERROR: " . $response['description'] . "\n", FILE_APPEND);
    }

    return $res;
}