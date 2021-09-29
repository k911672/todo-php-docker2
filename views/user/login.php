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
    $login = new LoginController;
    $user = $login->login();

  ?>

  <h1>Login</h1>
  <form action="./login.php" method="GET">
    <input type="text" name="name" placeholder="名前"><br />
    <input type="password" name="password" placeholder="パスワード"><br />
    <button type="submit" name="register">ログイン</button><br />
  </form>
  <br />
  <button><a href="./signUp.php">Sign Up</a></button>

  <?php
    var_dump($user);
    if($user['name'] === $_GET['name'] && $user['password'] === $_GET['password']){
      header('Location: ../todos/index.php');
    }
    if($user['name'] !== $_GET['name']){
      if($user['password'] !== $_GET['password']){
        header("Location: ./login.php?"."name=".$data['name']."&password="."*****");
      }
    }
  ?>

</body>
