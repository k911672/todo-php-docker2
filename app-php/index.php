<?php 
require 'db_connection.php';

$sqlUsers = 'select * from users where id = :id';
$stmtUsers = $pdo->prepare($sqlUsers);
$stmtUsers->bindValue('id', 1, PDO::PARAM_INT);
$stmtUsers->execute();

$users = $stmtUsers->fetchAll();

$sqlTodos = 'select * from todos where id = :id';
$stmtTodos = $pdo->prepare($sqlTodos);
$stmtTodos->bindValue('id', 1, PDO::PARAM_INT);
$stmtTodos->execute();

$todos = $stmtTodos->fetchAll();

foreach ($users[0] as $usersColumn => $usersRecord) {
    echo $usersColumn.' : '.$usersRecord."\n";
}
foreach ($todos[0] as $todosColumn => $todosRecord) {
    echo $todosColumn.' : '.$todosRecord."\n";
}