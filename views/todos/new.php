


<h1>入力フォーム</h1>
<form action="./new.php" method="GET">
    <input type="text" name="title" placeholder="todoを入力" value="<?php if(!empty($_GET['title'])){ echo $_GET['title'];} ?>"><br />
    <textarea name="detail" placeholder="todoの詳細を記入"><?php if(!empty($_GET['detail'])){echo $_GET['detail'];}?></textarea><br />
    <button type="submit" name="button">登録する</button><br />
</form>

<?php 
        require("../../controllers/TodoController.php");
        TodoController::new();
?>