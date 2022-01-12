<!DOCTYPE html>
<meta charset="utf-8">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="../js/jquery-3.6.0.min.js"></script>
    <title>Todo</title>
</head>
<body>
    <?php
    require_once("../../controllers/TodoController.php");
    $todoController = new TodoController;
    $todos = $todoController->index();
    $pageData = $todoController->changePage();
    $allTodo = count($todos)
    ?>

    <!-- ソート機能 -->
    <div class="msg"></div>
    <form action="./index.php" method="GET">
        <input type="text" name="title" placeholder="検索"><br />
        <input type="radio" name="status" value="1" > 未完了
        <input type="radio" name="status" value="2"> 完了<br />
        <input type="radio" name="row" value="asc" > 昇順
        <input type="radio" name="row" value="desc"> 降順<br />
        <button type="submit" name="submit">検索</button>
    </form>

    <!-- todo表示 -->
    <ul>
        <?php for ($i = $pageData['fromRecord'] - 1; $i < $pageData['toRecord']; $i++):?>
                <li class="todo">
                    <input
                        type="checkbox"
                        id="<?php echo $todos[$i]['id'] ?>"
                        name="check[]"
                        value="<?php echo $todos[$i]['status'] ?>"
                        <?php if ($todos[$i]['status'] == 2) { echo "checked='checked'"; } ?>
                    >
                    <a href="./detail.php?todo_id=<?php echo $todos[$i]['id']?>"><?php echo $todos[$i]['title']; ?></a>
                </li>
                <button><a href="./edit.php?todo_id=<?php echo $todos[$i]['id'];?>">編集</a></button>
                <button
                    id="<?php echo $todos[$i]['id'] ?>"
                    name="delete[]"
                >削除</button>
        <?php endfor; ?>
    </ul>

    <!-- todoの登録画面へのボタン -->
    <a href="./new.php">todo登録</a>

    <!-- ページネーション追加 -->
    <div class = "pagination">
        <p class="from_to"><?php echo $pageData['$allTodo']; ?>件中 <?php echo $pageData['fromRecord']; ?> - <?php echo $pageData['toRecord'];?> 件目を表示</p>

        <!-- 戻るボタン -->
        <?php if ($pageData['page'] >= 2): ?>
            <a href="index.php?page=<?php echo($pageData['page'] - 1); ?>" class="page_feed">&laquo;</a>
        <?php else:?>
            <span class="first_last_page">&laquo;</span>
        <?php endif; ?>

        <!-- ページ数の表示（ページのmax値までループ、現在のページとループした値が同じなら通常、それ以外はGETパラメーター付きのリンクをつける） -->
        <?php for ($i = 1; $i <= $pageData['maxPage']; $i++) : ?>
            <?php if($i >= $pageData['page'] - $pageData['range'] && $i <= $pageData['page'] + $pageData['range']) : ?>
                <?php if($i == $pageData['page']) : ?>
                    <span class="now_page_number"><?php echo $i; ?></span>
                <?php else: ?>
                    <a href="?page=<?php echo $i; ?>" class="page_number"><?php echo $i; ?></a>
                <?php endif; ?>
            <?php endif; ?>
        <?php endfor; ?>

        <!-- 進むボタン -->
        <?php if($pageData['page'] < $pageData['maxPage']) : ?>
            <a href="index.php?page=<?php echo($pageData['page'] + 1); ?>" class="page_feed">&raquo;</a>
        <?php else : ?>
            <span class="first_last_page">&raquo;</span>
        <?php endif; ?>
    </div>



    <!-- <p>1 GET<?php var_dump($_GET)?></p>
    <p>2 POST<?php var_dump($_POST)?></p>
    <p>3 todos<?php var_dump($todos)?></p>
    <?php foreach ($todos as $todo) : ?>
        <p>4 todos<?php var_dump($todo['status'])?></p>
    <?php endforeach; ?> -->

    <script src="../js/main.js"></script>
</body>
