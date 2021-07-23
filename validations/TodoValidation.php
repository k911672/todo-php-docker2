<?php

class TodoValidation {
    public static $errors;

    public static function check($title, $detail){
        if(empty($title)){
            self::$errors[] = "タイトルをご入力ください。\n";
            return false;
        }
        if(mb_strlen($title) > 10 || empty($title)){
            self::$errors[] = "タイトルは10文字以内でお願いいたします。\n";
            return false;
        }
        if(empty($detail) ){
            self::$errors[] = "詳細をご入力ください\n";
            return false;
        }
        if(mb_strlen($detail) > 25 || empty($detail) ){
            self::$errors[] = "詳細は25字以内でお願いいたします。\n";
            return false;
        }

        return true;
    }

    
}


?>