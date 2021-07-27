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

<?php 
        require("../../controllers/TodoController.php");
        $data = TodoController::new();
?>

<h1>入力フォーム</h1>
<form action="./new.php" method="POST">
    <input type="text" name="title" placeholder="todoを入力" value="<?php if(!empty($data['title'])){ echo $data['title'];} ?>"><br />
    <textarea name="detail" placeholder="todoの詳細を記入"><?php if(!empty($data['detail'])){echo $data['detail'];}?></textarea><br />
    <button type="submit" name="button">登録する</button><br />
</form>
<p><?php echo $data['title'];?></p>

<?php foreach ($_SESSION['errors'] as $error) :?>
    <li><?php echo $error ;?></li>        
<?php endforeach ;?>   