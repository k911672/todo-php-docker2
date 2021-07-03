<?php
require_once("../../models/Todo.php");

class TodoController {
    public function index() {
        $todo = new Todo;
        $todos = $todo->findAll();
        return $todos;
    }

    public function detail($todo_id){
        $todo = new Todo;
        $details = $todo->findById($todo_id);
        return $details;
    }
}







?>