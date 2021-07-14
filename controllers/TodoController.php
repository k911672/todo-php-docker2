<?php
require_once("../../models/Todo.php");

class TodoController {
    public function index() {
        $todos = Todo::findAll();
        return $todos;
    }

    public function detail(){
        $todo_id = $_GET["todo_id"];
        if (empty($todo_id)) {
            header('Location: ../error/404.php');
        }

        $todo = Todo::findById($todo_id);
        if (empty($todo)) {
            header('Location: ../error/404.php');
        }
        return $todo;
    }

    public static function new(){
        //もしリクエストメソッドがPOSTでなければ、処理終了
        if(!empty($_GET['title'])){
            // if (filter_input(INPUT_SERVER, 'SCRIPT_NAME') !== '/todos/new.php') {
                if(mb_strlen($_GET['title']) >= 10){
                    // header("Location: ../todos/new.php?title=".$_SERVER['QUERY_STRING']."&detail=".$_SERVER['QUERY_STRING']);
                    header("Location: ../todos/new.php?title=".$_SERVER['QUERY_STRING']);
                    exit();
                }
                if(mb_strlen($_GET['detail']) >= 25){
                    // header("Location: ../todos/new.php?title=".$_SERVER['QUERY_STRING']."&detail=".$_SERVER['QUERY_STRING']);
                    header("Location: ../todos/new.php?title=".$_SERVER['QUERY_STRING']);
                    exit();
                }
            // }
            Todo::save();
            header("Location: ../todos/index.php");
        }

        //パラメータ取得
        //バリデーション
            //もし不正な値なら再度、new.php に遷移させる
            //入力した内容は、入力欄に保持したい


        //もし保存に失敗したら、再度、new.php に遷移させる
        //入力した内容は、入力欄に保持したい
        //保存に成功したら、TOPに遷移
    }
}







?>