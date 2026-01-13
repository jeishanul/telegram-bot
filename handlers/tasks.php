<?php

$tasks = $db->query("SELECT * FROM tasks")->fetchAll(PDO::FETCH_ASSOC);

$keyboard = ["inline_keyboard" => []];

foreach ($tasks as $t) {
    $keyboard['inline_keyboard'][] = [
        ["text" => $t['title'] . " ($" . $t['reward'] . ")", "callback_data" => "task_" . $t['id']]
    ];
}

sendMessage($chat_id, "📋 Available Tasks:", $keyboard);
