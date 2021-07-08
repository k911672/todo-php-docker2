<?php
require_once("../../models/Todo.php");

class TodoController {
    public function index() {
        $todo = new Todo;
        $todos = $todo->findAll();
        return $todos;
    }

    public function detail(){
        $todo_id = $_GET["todo_id"];
        if (empty($todo_id)) {
            header('Location: ../error/404.php');
        }

        $details = Todo::findById($todo_id);
        if (empty($details)) {
            header('Location: ../error/404.php');
        }
        return $details;
    }
}







?>