<?php

require_once("../../models/User.php");
require_once("../../validations/UserValidation.php");
require_once("../../controllers/libs/Mail.php");

class UserController {

    public static function editNameAndPassword(){
        session_start();//session_start()の位置正しいか今度考える（sessionの値がないと出るため）

        if($_SERVER["REQUEST_METHOD"] === "POST" ){
            $name = $_POST['name'];
            $password = $_POST['password'];
            $token = $_POST['token'];
            $user = User::getUserNameByToken($token);
            $age = $user['age'];

            $data = array(
                'name' => $name,
                'password' => $password,
                'age' => $age,
                'token' => $token,
            );

            $validation = new UserValidation;
            if(!$validation->signUpCheck($data)){
                $_SESSION['errors'] = $validation->errors;
                header("Location: ../user/signUp.php?token=".$_POST["token"]);//GETパラメーターの記述必要
                return;
            }

            if (!User::saveCredential($data)){
                header("Location: ../user/signUp.php?token=".$_POST["token"]);
                return;
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

    public static function editMail(){
        session_start();//session_start()の位置正しいか今度考える（sessionの値がないと出るため）

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $mail = $_POST['mail'];
            $token = $_POST['token'];
            $user = User::getUserNameByToken($token);
            $name = $user['name'];
            $age = $user['age'];
            $password = $user['password'];

            $data = array(
                'mail' => $mail,
                'name' => $name,
                'password' => $password,
                'age' => $age,
                'token' => $token,
            );

            $validation = new UserValidation;
            if(!$validation->enterEmailCheck($data)){
                $_SESSION['errors'] = $validation->errors;
                header("Location: ../user/editMail.php?token=".$_POST["token"]);//GETパラメーターの記述必要
                return;
            }

            if (!User::editMail($data)){
                header("Location: ../user/editMail.php?token=".$_POST["token"]);
                return;
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

    public static function userAuthByMail(){
      session_start();//session_start()の位置正しいか今度考える（sessionの値がないと出るため）

      if($_SERVER["REQUEST_METHOD"] === "POST"){
          $mail = $_POST['mail'];
          $data = array(
              'mail' => $mail,
          );

          $validation = new UserValidation;
          if(!$validation->userAuthByMailCheck($data)){
              $_SESSION['errors'] = $validation->errors;
              header("Location: ../user/userAuthByMail.php");
              return;
          }

          $user = User::getUserByEnterMail($mail);

          $mail = new Mail;
          $mail->to = $user['mail'];
          $mail->subject = 'TEST MAILS';
          $mail->message = <<< EOM
          Please click on the URL
          http://localhost/user/editNameAndPassword.php?token={$user['token']}
          EOM;
          $mail->headers = 'From: k911672@gmail.com';
          $mail->send();

          header("Location: ../user/completeSending.php");
      }

      $mail = isset($_GET['mail'])? $_GET['mail']: "";
      $data = array(
          'mail' => $mail,
      );
      return $data;
  }

  public static function userAuthByRegisteredInfo(){
      session_start();//session_start()の位置正しいか今度考える（sessionの値がないと出るため）

      if($_SERVER["REQUEST_METHOD"] === "POST"){
          $name = $_POST['name'];
          $age = $_POST['age'];
          $password = $_POST['password'];

          $data = array(
              'name' => $name,
              'age' => $age,
              'password' => $password,
          );

          $validation = new UserValidation;
          if(!$validation->userAuthByRegisteredInfoCheck($data)){
              $_SESSION['errors'] = $validation->errors;
              header("Location: ../user/userAuthByRegisteredInfo.php");
              return;
          }

          $user = User::getUserByRegisteredInfo($data);

          $mail = new Mail;
          $mail->to = $user['mail'];
          $mail->subject = 'TEST MAILS';
          $mail->message = <<< EOM
          Please click on the URL
          http://localhost/user/editMail.php?token={$user['token']}
          EOM;
          $mail->headers = 'From: k911672@gmail.com';
          $mail->send();

          header("Location: ../user/completeSending.php");
      }

      $name = isset($_GET['name'])? $_GET['name']: "";
      $age = isset($_GET['age'])? $_GET['age']: "";
      $password = isset($_GET['password'])? $_GET['password']: "";
      $data = array(
          'name' => $name,
          'age' => $age,
          'password' => $password,
      );
      return $data;
  }

}

?>
