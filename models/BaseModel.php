<?php

class BaseModel {
    const DB_HOST = 'mysql:dbname=todo; host=mysql';
    const DB_USER = 'naoki';
    const DB_PASSWORD = '11922960Kim@';
    
    public function getPdoInstance(){
        $pdo = new PDO(BaseModel::DB_HOST, BaseModel::DB_USER, BaseModel::DB_PASSWORD,[
            PDO :: ATTR_DEFAULT_FETCH_MODE => PDO :: FETCH_ASSOC,//データベースから返って来る値を連想配列で返す。
            PDO :: ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,//例外を表示する。
            PDO :: ATTR_EMULATE_PREPARES => false//SQLインジェクション対策
        ]);

        return $pdo;
    }
}








?>