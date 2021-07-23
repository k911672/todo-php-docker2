<?php
require_once("../../models/Todo.php");
require_once("../../validations/TodoValidation.php");

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
        session_start();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $title = $_POST['title'];
            $detail = $_POST['detail'];
            $data = array(
                'title' => $title,
                'detail' => $detail
            );
            if(!TodoValidation::check($title, $detail)){
                $_SESSION['errors'] = TodoValidation::$errors;
                header("Location: ../todos/new.php?"."title=".$data['title']."&detail=".$data['detail']);
                return;
            }

            header("Location: ../todos/index.php");

            if (!Todo::save($data)){
                header("Location: ../todos/new.php?"."title=".$data['title']."&detail=".$data['detail']);
            }
        }

        $title = $_GET['title'];
        $detail = $_GET['detail'];
        $data = array(
            'title' => $title,
            'detail' => $detail
        );
        
        return $data;
    }
}







?>