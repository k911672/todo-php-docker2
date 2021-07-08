
<?php 
    require_once("../../controllers/TodoController.php");
    $todoController = new TodoController;
    $todo = $todoController->detail();
?>

<ul>
    <?php foreach ($todo as $item => $detail) : ?>
        <li><?php echo $item." : ".$detail; ?></li>
    <?php endforeach; ?>
</ul>
