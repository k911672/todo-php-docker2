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
  $data = LoginController::login();

  ?>


  <h1>Login</h1>
  <form action="./login.php" method="POST">
    <input type="text" name="name" placeholder="名前"><br />
    <input type="password" name="password" placeholder="パスワード"><br />
    <button type="submit" name="register">ログイン</button><br />
  </form>
  <br />
  <button><a href="./enterEmail.php">Sign Up</a></button><br />
  <a href="./userAuthByMail.php">ユーザー名・パスワードの変更</a><br />
  <a href="./userAuthByRegisteredInfo.php">メールアドレスの変更</a><br />

  <?php foreach ($_SESSION['errors'] as $error) :?>
    <li><?php echo $error ;?></li>
  <?php endforeach ;?>

</body>
