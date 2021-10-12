<!DOCTYPE html>
<meta charset="utf-8">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Todo</title>
</head>

<?php
session_start();
if($_SESSION['flg_main'] !== "2"){
    header('Location: ../user/login.php');
}

require_once("../../controllers/TodoController.php");
$todoController = new TodoController;
$todo = $todoController->detail();

$_SESSION = array();
$_SESSION['flg'] = "1"

?>

<h1><?php echo $todo['title']; ?></h1>
<p><?php echo $todo['detail']; ?></p>
