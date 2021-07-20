<?php

class TodoValidation {
    public static function check($title, $detail){
        if(mb_strlen($title) >= 10 || empty($title)){
            return false;
        }
        if(mb_strlen($detail) >= 25 || empty($title) ){
            return false;
        }

        return true;
    }
}


?>