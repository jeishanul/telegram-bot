<?php
// seed.php
try {
    $db_path = __DIR__ . '/database/bot.sqlite';
    
    // Ensure the file exists (creates automatically)
    if (!file_exists($db_path)) {
        file_put_contents($db_path, '');
    }

    $db = new PDO('sqlite:' . $db_path);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create tables
    $db->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT,
        chat_id INTEGER
    )");

    $db->exec("CREATE TABLE IF NOT EXISTS tasks (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER,
        task TEXT,
        completed INTEGER DEFAULT 0
    )");

    // Insert default users
    $db->exec("INSERT INTO users (username, chat_id) VALUES 
        ('Jeishanul', 2077162700),
        ('TestUser', 1234567890)
    ");

    echo "✅ Database seeded successfully!";
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
