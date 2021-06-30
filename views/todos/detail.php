
<?php 
    require_once("../../controllers/TodoController.php");
    $todoController = new TodoController;
    $details = $todoController->detail();
?>
<ul>
    <?php foreach ($details as $detail) : ?>
        <li><?php echo $detail['detail']; ?></li>
    <?php endforeach; ?>
</ul>
