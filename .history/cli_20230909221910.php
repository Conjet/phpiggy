<?php

include __DIR__ . "/src/Framework/Database.php";

use Framework\Database;

$db = new Database('mysql', [
    'host' => 'localhost',
    'port' => 3306,
    'dbname' => 'phpiggy'
], 'root', '');

$search = "Hatt";

$query = "SELECT * FROM products WHERE name=:name";

$stmt = $db->connection->prepare($query);
$stmt->bindValue('name', $search, PDO::PARAM_STR);
$stmt->execute([
    'name' => 
]);
var_dump($stmt->fetchAll(PDO::FETCH_OBJ));
