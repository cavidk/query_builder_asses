<?php

use config\Database;
use src\QueryBuilder;

require 'config/database.php';
require 'src/QueryBuilder.php';

$pdo = Database::connect();

if (!$pdo) {
    echo json_encode(['status' => 'Failed to connect to the database']);
    exit();
}

$queryBuilder = new QueryBuilder($pdo);

$results = $queryBuilder->table('users')
    ->select('name, email')
    ->where('age', '>', 20)
    ->orderBy('name', 'DESC')
    ->limit(10)
    ->get();


// Display the results
foreach ($results as $user) {
    echo $user->name . ' - ' . $user->email . "<br>";
}


header('Content-Type: application/json');
echo json_encode($results);

