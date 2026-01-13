<?php

if (!isset($update['callback_query']))
    return;

$data = $update['callback_query']['data'];
$chat_id = $update['callback_query']['message']['chat']['id'];

if (strpos($data, "task_") === 0) {
    $task_id = str_replace("task_", "", $data);

    $task = $db->query("SELECT * FROM tasks WHERE id=$task_id")->fetch();
    $db->prepare("REPLACE INTO user_states VALUES(?,?)")->execute([$chat_id, "proof:$task_id"]);

    sendMessage(
        $chat_id,
        "📌 " . $task['title'] . "\n\n" . $task['description'] . "\n\n" .
        "Send your " . ($task['proof_type'] == "screenshot" ? "📸 screenshot" : "📝 text") . " now."
    );
}
