<!DOCTYPE html>
<meta charset="utf-8">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Todo</title>
</head>
<body>
    <?php 
        require_once("../../controllers/TodoController.php");
        $todoController = new TodoController;
        $todos = $todoController->index();

        
    ?>
    <form action="./index.php" method="GET">
        <input type="text" name="title" placeholder="検索"><br />
        <input type="radio" name="status" value="0" > 未完了
        <input type="radio" name="status" value="1"> 完了<br />
        <input type="radio" name="row" value="asc" > 昇順
        <input type="radio" name="row" value="desc"> 降順<br />
        <button type="submit" name="submit">検索</button>
    </form>
  
    <ul>
        <?php foreach ($todos as $todo) : ?>
            <li>
                <input type="checkbox" id="checkbox" name="checkbox" value="0">
                <a href="./detail.php?todo_id=<?php echo $todo['id']?>"><?php echo $todo['title']; ?></a>
            </li>
            <button><a href="./edit.php?todo_id=<?php echo $todo['id'];?>">編集</a></button>
        <?php endforeach; ?>
    </ul>
    <p><?php echo $_GET['row'];?></p>
    <a href="./new.php">todo登録</a>
    <script src="../js/main.js"></script>

 
</body>


