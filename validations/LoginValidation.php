<?php

require_once("../../models/User.php");


class LoginValidation {
    public $errors;

    public function loginCheck($data){
        $user = User::getUserByNameAndPassword($data);

        if(empty($data['name'])){
            $this->errors[] = "ユーザー名をご入力ください。\n";
        }
        if(mb_strlen($data['name']) > 10){
            $this->errors[] = "名前は10文字以内でお願いいたします。\n";
        }
        if(empty($data['password'])){
            $this->errors[] = "パスワードをご入力ください\n";
        }
        if(mb_strlen($data['password']) < 8){
            $this->errors[] = "パスワードは8字以上でお願いいたします。\n";
        }
        if($user['name'] !== $data['name'] || $user['password'] !== $data['password']){
            $this->errors[] = "ユーザー名、もしくはパスワードが間違っております。\n";
        }

        if(!empty($this->errors)){
            return false;
        }

        return true;
    }

    public function signUpCheck($data){
        if(empty($data['name'])){
            $this->errors[] = "ユーザー名をご入力ください。\n";
        }
        if(mb_strlen($data['name']) > 10){
            $this->errors[] = "名前は10文字以内でお願いいたします。\n";
        }
        if(empty($data['password']) ){
            $this->errors[] = "パスワードをご入力ください\n";
        }
        if(mb_strlen($data['password']) < 8){
            $this->errors[] = "パスワードは8字以上でお願いいたします。\n";
        }
        if(empty($data['age']) ){
            $this->errors[] = "年齢をご入力ください\n";
        }

        if(!empty($this->errors)){
            return false;
        }

        return true;
    }

    public function enterEmailCheck($data){
        if(empty($data['mail']) ){
            $this->errors[] = "メールアドレスをご入力ください\n";
        }

        if(!empty($this->errors)){
            return false;
        }

        return true;
    }


}


?>
