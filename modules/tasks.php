<?php
$tasks = $db->query("SELECT * FROM tasks")->fetchAll(PDO::FETCH_ASSOC);

if (!$tasks) {
    sendMessage($chat_id, "No tasks available now.");
    return;
}

$msg = "📋 Available Tasks:\n\n";
foreach ($tasks as $t) {
    $msg .= "{$t['id']}. {$t['title']} - {$t['reward']}৳\n";
}
$msg .= "\nSend: submit TASK_ID proof";

sendMessage($chat_id, $msg);
