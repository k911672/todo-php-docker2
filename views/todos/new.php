
<?php if(!empty($_POST['title'])):?>
    <?php
        require("../../models/Todo.php");
        Todo::insertValue();
    ?>
<?php endif; ?>

    <h1>入力フォーム</h1>
    <form action="./new.php" method="POST">
        <input type="text" name="title" placeholder="todoを入力"><br />
        <textarea name="detail" placeholder="todoの詳細を記入"></textarea><br />
        <button type="submit" name="button">登録する</button><br />
    </form>