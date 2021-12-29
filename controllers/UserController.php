<?php

require_once("../../models/User.php");
require_once("../../validations/UserValidation.php");
require_once("../../controllers/libs/Mail.php");

class UserController {

    public static function edit(){
        session_start();//session_start()の位置正しいか今度考える（sessionの値がないと出るため）

        if($_SERVER["REQUEST_METHOD"] === "POST" ){
            $mail = $_POST['mail'];
            $name = $_POST['name'];
            $password = $_POST['password'];
            $token = $_POST['token'];
            $user = User::getUserNameByToken($token);
            $age = $user['age'];

            $data = array(
                'mail' => $mail,
                'name' => $name,
                'password' => $password,
                'age' => $age,
                'token' => $token,
            );

            $validation = new UserValidation;

            //メールアドレス変更のバリデーション
            if (!isset($name) || !isset($password)) {
              $validation = new UserValidation;
              if(!$validation->editMailCheck($data)){
                  $_SESSION['errors'] = $validation->errors;
                  header("Location: ../user/editMail.php?token=".$_POST["token"]);//GETパラメーターの記述必要
                  return;
              }

              if (!User::editMail($data)){
                  header("Location: ../user/editMail.php?token=".$_POST["token"]);
                  return;
              }
            }

            //パスワード、ユーザー名変更のバリデーション
            if (!isset($mail)) {
              if(!$validation->editNameAndPasswordCheck($data)){
                  $_SESSION['errors'] = $validation->errors;
                  header("Location: ../user/editNameAndPassword.php?token=".$_POST["token"]);//GETパラメーターの記述必要
                  return;
              }

              if (!User::saveCredential($data)){
                  header("Location: ../user/editNameAndPassword.php?token=".$_POST["token"]);
                  return;
              }
            }

            header("Location: ../user/completeRegistration.php");
        }

        $name = isset($_GET['name'])? $_GET['name']: "";
        $password = isset($_GET['password'])? $_GET['password']: "";
        $age = isset($_GET['age'])? $_GET['age']: "";
        $token = isset($_GET['token'])? $_GET['token']: "";
        $data = array(
            'name' => $name,
            'password' => $password,
            'age' => $age,
            'token' => $token,
        );
        return $data;
    }

    public static function checkAuth(){
      session_start();//session_start()の位置正しいか今度考える（sessionの値がないと出るため）

      if($_SERVER["REQUEST_METHOD"] === "POST"){
          $mail = isset($_POST['mail'])? $_POST['mail']: "";
          $name = isset($_POST['name'])? $_POST['name']: "";
          $age = isset($_POST['age'])? $_POST['age']: "";
          $password = isset($_POST['password'])? $_POST['password']: "";

          $data = array(
              'mail' => $mail,
              'name' => $name,
              'age' => $age,
              'password' => $password,
          );

          $validation = new UserValidation;

          if (empty($name) || empty($password)) {
            if(!$validation->userAuthByMailCheck($data)){
              $_SESSION['errors'] = $validation->errors;
              header("Location: ../user/userAuthByMail.php");
              return;
            }
            $user = User::getUserByEnterMail($mail);
          }

          if (empty($mail)) {
            if(!$validation->userAuthByRegisteredInfoCheck($data)){
              $_SESSION['errors'] = $validation->errors;
              header("Location: ../user/userAuthByRegisteredInfo.php");
              return;
            }
            $user = User::getUserByRegisteredInfo($data);
          }

          $email = new Mail;
          $email->to = $user['mail'];
          $email->subject = 'TEST MAILS';
          if (empty($name) || empty($password)) {
            $email->message = <<< EOM
            Please click on the URL
            http://localhost/user/editNameAndPassword.php?token={$user['token']}
            EOM;
          }
          if (empty($mail)) {
            $email->message = <<< EOM
            Please click on the URL
            http://localhost/user/editMail.php?token={$user['token']}
            EOM;
          }
          $email->headers = 'From: k911672@gmail.com';
          $email->send();

          header("Location: ../user/completeSending.php");
      }

      $mail = isset($_GET['mail'])? $_GET['mail']: "";
      $data = array(
          'mail' => $mail,
      );
      return $data;
  }

}

?>
