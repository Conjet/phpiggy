<?php

include __DIR__ . "/src/Framework/Database.php";

use Framework\Database;

$db = new Database('mysql', [
    'host' => 'localhost',
    'port' => 3306,
    'dbname' => 'phpiggy'
], 'root', '');

$search = "Hats' OR 1=1 -- ";

$query = "SELECT * FROM products WHERE name='{$search}'";

$stmt = $db->connection->prepare($query);

var_dump($stmt->fetchAll(PDO::FETCH_OBJ));
