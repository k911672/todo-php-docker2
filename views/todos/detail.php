
<?php 
    require_once("../../controllers/TodoController.php");
    $todoController = new TodoController;
    $details = $todoController->detail($_GET["todo_id"]);
?>

<?php var_dump($_GET["todo_id"]) ?>

<ul>
    <?php foreach ($details as $detail) : ?>
        <li><?php echo $detail['detail']; ?></li>
    <?php endforeach; ?>
</ul>
