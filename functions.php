<?php

require "db.php";

function sendMessage($chat_id, $text, $keyboard = null)
{
    $data = [
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => 'HTML'
    ];
    if ($keyboard)
        $data['reply_markup'] = json_encode($keyboard);
    file_get_contents(API_URL . "sendMessage?" . http_build_query($data));
}

function setState($telegram_id, $state)
{
    global $db;
    $db->prepare("REPLACE INTO user_states VALUES(?,?)")->execute([$telegram_id, $state]);
}

function getState($telegram_id)
{
    global $db;
    $q = $db->prepare("SELECT state FROM user_states WHERE telegram_id=?");
    $q->execute([$telegram_id]);
    return $q->fetchColumn() ?? STATE_NONE;
}
