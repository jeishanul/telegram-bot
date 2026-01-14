<?php
require "config.php";

$sql = "
CREATE TABLE IF NOT EXISTS users (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  telegram_id INTEGER UNIQUE,
  username TEXT,
  balance REAL DEFAULT 0,
  state TEXT DEFAULT NULL,
  ref_by INTEGER DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS tasks (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  title TEXT,
  description TEXT,
  reward REAL,
  proof_type TEXT,
  status TEXT DEFAULT 'active'
);

CREATE TABLE IF NOT EXISTS submissions (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  user_id INTEGER,
  task_id INTEGER,
  proof TEXT,
  status TEXT DEFAULT 'pending',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS withdrawals (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  user_id INTEGER,
  amount REAL,
  method TEXT,
  account TEXT,
  status TEXT DEFAULT 'pending',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS referrals (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  user_id INTEGER,
  referred_user INTEGER,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
";

$pdo->exec($sql);
echo "SQLite DB ready!";
