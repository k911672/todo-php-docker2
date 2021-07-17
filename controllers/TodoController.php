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
        if($_SERVER["REQUEST_METHOD"] !== "POST"){
            return;
        }

        $title = $_POST['title'];
        $detail = $_POST['detail'];
        $data = array(
            'title' => $title,
            'detail' => $detail
        );
        
        if(mb_strlen($title) >= 10){
            return $title;
        }
        if(mb_strlen($detail) >= 25){
            return;
        }
        if (!Todo::save($data)){
            return;
        }

        header("Location: ../todos/index.php");

        //もし保存に失敗したら、再度、new.php に遷移させる
        //入力した内容は、入力欄に保持したい
    }
}







?>