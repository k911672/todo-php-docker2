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
    $data = LoginController::enterEmail();

    mb_language("Japanese");
    mb_internal_encoding("UTF-8");
    var_dump(
      mb_send_mail(
        $_POST["mail"],
        'TEST MAILS',
        'http://localhost/user/signUp.php?token='.$_POST["token"],
        'From: k911672@gmail.com'
      )
    )
  ?>

  <h1>Please enter your email!</h1>
  <form action="./enterEmail.php" method="POST">
    <input type="email" name="mail" placeholder="メールアドレス"><br />
    <input type="hidden" name="token" value="<?php echo uniqid(bin2hex(random_bytes(1))) ?>"><br/>
    <button type="submit" name="register">登録</button><br />
  </form>
  <button><a href="./login.php"> 戻る</a></button>

  <?php foreach ($_SESSION['errors'] as $error) :?>
    <li><?php echo $error ;?></li>
  <?php endforeach ;?>

</body>
