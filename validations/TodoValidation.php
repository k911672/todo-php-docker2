<?php

class TodoValidation {
    public $errors;

    public function check($title, $detail){
        if(empty($title)){
            $this->errors[] = "タイトルをご入力ください。\n";
        }
        if(mb_strlen($title) > 10 || empty($title)){
            $this->errors[] = "タイトルは10文字以内でお願いいたします。\n";
        }
        if(empty($detail) ){
            $this->errors[] = "詳細をご入力ください\n";
        }
        if(mb_strlen($detail) > 25 || empty($detail) ){
            $this->errors[] = "詳細は25字以内でお願いいたします。\n";
        }


        if(!empty($this->errors)){
            return false;
        }

        return true;
    }
}


?>