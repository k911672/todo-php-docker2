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
        $details = $todo->findById();
        return $details;
    }
}







?>