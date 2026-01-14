<?php
try {
    $db = new PDO("sqlite:" . DB_FILE);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db->exec("
        CREATE TABLE IF NOT EXISTS users(
            id INTEGER PRIMARY KEY,
            telegram_id INTEGER UNIQUE,
            balance REAL DEFAULT 0,
            ref_by INTEGER DEFAULT NULL
        );

        CREATE TABLE IF NOT EXISTS tasks(
            id INTEGER PRIMARY KEY,
            title TEXT,
            reward REAL
        );

        CREATE TABLE IF NOT EXISTS submissions(
            id INTEGER PRIMARY KEY,
            user_id INTEGER,
            task_id INTEGER,
            proof TEXT,
            status TEXT DEFAULT 'pending'
        );
    ");

    // Auto-seed default tasks if the table is empty
    $stmt = $db->query("SELECT COUNT(*) FROM tasks");
    if ($stmt->fetchColumn() == 0) {
        $db->exec("INSERT INTO tasks (title, reward) VALUES
        ('Join our Telegram channel', 20),
        ('Follow us on X/Twitter', 15),
        ('Subscribe to YouTube channel', 25),
        ('Like & retweet pinned post', 30),
        ('Visit our website', 10)
    ");
        // Optional: log this for debugging
        file_put_contents("debug.log", "Default tasks seeded\n", FILE_APPEND);
    }

} catch (Exception $e) {
    file_put_contents("debug.log", $e->getMessage(), FILE_APPEND);
    exit;
}
