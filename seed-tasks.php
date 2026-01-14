<?php
require "config.php";
require "db.php";

$count = $db->query("SELECT COUNT(*) FROM tasks")->fetchColumn();

if ($count > 0) {
    echo "Tasks already exist ($count). Nothing done.";
    exit;
}

$db->exec("INSERT INTO tasks (title, reward) VALUES
    ('Join our Telegram channel', 20.0),
    ('Follow us on X/Twitter', 15.0),
    ('Subscribe to YouTube channel', 25.0),
    ('Like & retweet pinned post', 30.0),
    ('Visit our website and register', 10.0)
");

echo "✅ Tasks seeded successfully!";