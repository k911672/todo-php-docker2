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
    LoginController::userAuthenticationByMail();

  ?>

  <h1>Please enter your registered email !</h1>
  <form action="./userAuthenticationByMail.php" method="POST">
    <input type="email" name="mail" placeholder="メールアドレス"><br />
    <button type="submit" name="register">送信</button><br />
  </form>
  <button><a href="./login.php"> 戻る</a></button>

  <?php foreach ($_SESSION['errors'] as $error) :?>
    <li><?php echo $error ;?></li>
  <?php endforeach ;?>

</body>
