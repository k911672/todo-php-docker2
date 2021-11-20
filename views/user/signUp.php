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
    require_once("../../controllers/LoginController.php");
    $data = LoginController::signUp();

    mb_language("Japanese");
    mb_internal_encoding("UTF-8");
    var_dump(
      mb_send_mail(
        $_POST["mail"],
        'TEST MAILS',
        '登録が完了致しました。',
        'From: k911672@gmail.com'
      )
    )
  ?>

  <h1>Sign Up</h1>
  <form action="./signUp.php" method="POST">
    <input type="text" name="name" placeholder="名前"><br />
    <input type="text" name="age" placeholder="年齢"><br />
    <input type="password" name="password" placeholder="パスワード"><br />
    <input type="hidden" name="token" value="<?php echo $_GET['token'] ?>"><br />
    <button type="submit" name="register">登録</button><br />
  </form>
  <button><a href="./login.php"> 戻る</a></button>

  <?php foreach ($_SESSION['errors'] as $error) :?>
    <li><?php echo $error ;?></li>
  <?php endforeach ;?>

</body>
