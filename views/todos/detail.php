
<?php 
    require_once("../../controllers/TodoController.php");
    $todoController = new TodoController;
    $details = $todoController->detail();
    var_dump($details);
?>

<?php var_dump($_GET) ?>

<ul>
    <li><?php echo $details['detail']; ?></li>
</ul>
