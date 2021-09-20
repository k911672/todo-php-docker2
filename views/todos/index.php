<!DOCTYPE html>
<meta charset="utf-8">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="../js/jquery-3.6.0.min.js"></script>
    <title>Todo</title>
</head>
<body>
    <?php
        require_once("../../controllers/TodoController.php");
        $todoController = new TodoController;
        $todos = $todoController->index();
    ?>
    <div class="msg"></div>
    <form action="./index.php" method="GET">
        <input type="text" name="title" placeholder="検索"><br />
        <input type="radio" name="status" value="1" > 未完了
        <input type="radio" name="status" value="2"> 完了<br />
        <input type="radio" name="row" value="asc" > 昇順
        <input type="radio" name="row" value="desc"> 降順<br />
        <button type="submit" name="submit">検索</button>
    </form>

    <ul>
        <?php foreach ($todos as $todo) : ?>
            <li class="todo">
                <input
                    type="checkbox"
                    id="<?php echo $todo['id'] ?>"
                    name="check[]"
                    value="<?php echo $todo['status'] ?>"
                    <?php if ($todo['status'] == 2) { echo "checked='checked'"; } ?>
                >
                <a href="./detail.php?todo_id=<?php echo $todo['id']?>"><?php echo $todo['title']; ?></a>
            </li>
            <button><a href="./edit.php?todo_id=<?php echo $todo['id'];?>">編集</a></button>
        <?php endforeach; ?>
    </ul>

    <a href="./new.php">todo登録</a>
    <script src="../js/main.js"></script>



    <!-- <p>1 GET<?php var_dump($_GET)?></p>
    <p>2 POST<?php var_dump($_POST)?></p>
    <p>3 todos<?php var_dump($todos)?></p>
    <?php foreach ($todos as $todo) : ?>
        <p>4 todos<?php var_dump($todo['status'])?></p>
    <?php endforeach; ?> -->


</body>
