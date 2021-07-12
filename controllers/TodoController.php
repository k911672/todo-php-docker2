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

    public static function newTodo(){
        $todo = Todo::insertValue();
        return $todo;
    }
}







?>