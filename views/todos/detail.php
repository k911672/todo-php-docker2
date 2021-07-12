
<?php 
    require_once("../../controllers/TodoController.php");
    $todoController = new TodoController;
    $todo = $todoController->detail();
?>

<h1><?php echo $todo['title']; ?></h1>
<p><?php echo $todo['detail']; ?></p>
