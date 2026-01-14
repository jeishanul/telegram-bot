<?php

$parts = explode(" ", $text, 3);

if (count($parts) < 3) {
    sendMessage($chat_id, "❌ Format wrong.\nUse:\nsubmit TASK_ID your_proof");
    return;
}

$task_id = intval($parts[1]);
$proof   = trim($parts[2]);

// Check task exists
$stmt = $db->prepare("SELECT id FROM tasks WHERE id=?");
$stmt->execute([$task_id]);
if (!$stmt->fetch()) {
    sendMessage($chat_id, "❌ Invalid task ID.");
    return;
}

// Get user ID
$stmt = $db->prepare("SELECT id FROM users WHERE telegram_id=?");
$stmt->execute([$chat_id]);
$user_id = $stmt->fetchColumn();

// Check if already submitted
$stmt = $db->prepare("SELECT id FROM submissions WHERE user_id=? AND task_id=?");
$stmt->execute([$user_id, $task_id]);
if ($stmt->fetch()) {
    sendMessage($chat_id, "⚠️ You already submitted this task.");
    return;
}

// Save submission
$stmt = $db->prepare("INSERT INTO submissions(user_id, task_id, proof) VALUES(?,?,?)");
$stmt->execute([$user_id, $task_id, $proof]);

sendMessage($chat_id, "✅ Proof submitted!\nAdmin will review it.");
