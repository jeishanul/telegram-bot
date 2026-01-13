<?php

$state = getState($chat_id);
$task_id = explode(":", $state)[1];

if (isset($update['message']['photo'])) {
    $file_id = end($update['message']['photo'])['file_id'];
    $proof = "PHOTO:$file_id";
} else {
    $proof = $text;
}

$db->prepare("INSERT INTO submissions(telegram_id,task_id,proof) VALUES(?,?,?)")
    ->execute([$chat_id, $task_id, $proof]);

sendMessage($chat_id, "✅ Proof submitted. Waiting for approval.");
setState($chat_id, STATE_NONE);
