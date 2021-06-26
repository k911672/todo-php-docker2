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
<body>

    <?php 
        require_once("../../controllers/TodoController.php");

        $todoController = new TodoController;
        $todos = $todoController->index();
    ?>
    <h1>Todoリスト</h1>
    <form>
        <input type="text" placeholder="メールチェック">
        <button>todo作成</button>
    </form>
    <ul>
        <h2><?php echo $todos[0]['title'];?></h2>
        <?php foreach ($todos as $array) : ?>
            <li><?php echo $array['detail']; ?></li>
        <?php endforeach; ?>
    </ul>


</body>