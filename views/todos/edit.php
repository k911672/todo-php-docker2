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
        require("../../controllers/TodoController.php");
        $todo = TodoController::edit();
?>

<h1>入力フォーム</h1>
<form action="./edit.php" method="POST">
    <input type="text" name="title" placeholder="todoを入力" value="<?php if(isset($todo['title'])){ echo $todo['title'];} ?>"><br />
    <textarea name="detail" placeholder="todoの詳細を記入"><?php if(isset($todo['detail'])){echo $todo['detail'];}?></textarea><br />
    <button type="submit" name="button">登録する</button><br />
    <input type="hidden" name="todo_id" value="<?php if(isset($todo['id'])){ echo $todo['id'];} ?>"><br />
</form>

<?php foreach ($_SESSION['errors'] as $error) :?>
    <li><?php echo $error ;?></li>        
<?php endforeach ;?>   