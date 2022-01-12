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
  require_once("../../controllers/UserController.php");
  $data = UserController::edit();
  ?>

  <h1>Change your Information!</h1>
  <form action="./editNameAndPassword.php" method="POST">
    <input type="text" name="name" placeholder="名前"><br />
    <input type="password" name="password" placeholder="パスワード"><br />
    <input type="hidden" name="token" value="<?php echo $_GET['token'] ?>"><br />
    <button type="submit" name="register">変更</button><br />
  </form>
  <br />
  <a href="./login.php"> login画面に戻る</a><br>

  <?php foreach ($_SESSION['errors'] as $error) :?>
    <li><?php echo $error ;?></li>
  <?php endforeach ;?>
</body>
