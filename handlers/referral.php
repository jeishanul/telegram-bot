<?php

$start = explode(" ", $text);
if (isset($start[1])) {
    $referrer = $start[1];
    $user_id = $update['message']['from']['id'];

    $db->prepare("INSERT IGNORE INTO referrals(referrer,referred) VALUES(?,?)")
        ->execute([$referrer, $user_id]);

    sendMessage($chat_id, "🎉 You joined using a referral!");
}
