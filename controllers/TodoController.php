<?php
require_once("../../models/Todo.php");

class TodoController {
    public function index() {
        $todo = new Todo;
        $todos = $todo->findAll();
        return $todos;
    }

    public function detail(){
        $todo = new Todo;
        $todo_id = $_GET["todo_id"];
        $details = $todo->findById($todo_id);

        if (empty($todo_id)) {
            header('Location: ../error/404.php');
        }
        if ($details[0]['title'] != $todo_id) {
            header('Location: ../error/404.php');
        }

        return $details;
    }
}







?>