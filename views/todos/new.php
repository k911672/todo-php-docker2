
<?php if(!empty($_POST['title'])):?>
    <?php
        require("../../controllers/TodoController.php");
        TodoController::newTodo();
    ?>
<?php endif; ?>

    <h1>入力フォーム</h1>
    <form action="./new.php" method="POST">
        <input type="text" name="title" placeholder="todoを入力"><br />
        <textarea name="detail" placeholder="todoの詳細を記入"></textarea><br />
        <button type="submit" name="button">登録する</button><br />
    </form>