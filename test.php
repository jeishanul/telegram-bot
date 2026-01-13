<?php
require "db.php";
$q = $db->query("SELECT NOW() as time")->fetch();
echo "DB Connected! Server time: ".$q['time'];
