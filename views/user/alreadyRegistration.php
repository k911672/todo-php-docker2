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
  <?php if(isset($_GET['name'])) : ?>
    <div>このユーザー名（<?php echo $_GET['name'] ;?>）はすでに登録されております。</div>
  <?php endif; ?>
  <?php if(isset($_GET['mail'])) : ?>
    <div>このメールアドレス（<?php echo $_GET['mail'] ;?>）はすでに登録されております。</div>
  <?php endif; ?>
  <button><a href="./login.php">戻る</a></button>

</body>
