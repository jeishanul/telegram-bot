<?php

$email = $text;

$db->prepare("UPDATE users SET is_registered=1 WHERE telegram_id=?")->execute([$chat_id]);

sendMessage($chat_id, "✅ Email saved!\nUse /tasks to earn.");
setState($chat_id, STATE_NONE);
