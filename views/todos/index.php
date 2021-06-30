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
    <ul>
        <?php var_dump($todos) ?>
        <?php foreach ($todos as $todo) : ?>
            <li><a href="./detail.php"><?php echo $todo['title']; ?></a></li>
        <?php endforeach; ?>
        
    </ul>


</body>