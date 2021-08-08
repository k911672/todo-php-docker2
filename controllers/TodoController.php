<?php
require_once("../../models/Todo.php");
require_once("../../validations/TodoValidation.php");


class TodoController {
    public function index() {
        $title = $_GET['title'];
        $status = $_GET['status'];
        $row = $_GET['row'];

        if(empty($_GET['title'] || $_GET['row'] || $_GET['status'])){
            $todos = Todo::findAll();
        }

        $params = array(
            'title' => $title,
            'status' => $status,
            'row' => $row
        );

        if (!empty($_GET['title'] || $_GET['row'] || $_GET['status'])) {
            $query = $this->buildQuery($params);
            $todos = Todo::findByQuery($query);
        }
        return $todos;
    }

    private function buildQuery($params){
        if(!empty($params['title']) && empty($params['status'])){
            $query = "select * from todos where user_id=1 and title=:title";
        } 
        if(empty($params['title']) && !empty($params['status'])){
            $query = "select * from todos where user_id=1 and status=:status";
        } 
        if(!empty($params['title']) && !empty($params['status'])){
            $query = "select * from todos where user_id=1 and title=:title and status=:status";
        }
        if(empty($params['title']) && empty($params['status']) && !empty($params['row'])){
            $query = "select * from todos order by title ".$params['row'];
        } 
        if(!empty($params['title']) && empty($params['status']) && !empty($params['row'])){
            $query = "select * from todos where user_id=1 and title=:title order by title ".$params['row'];
        } 
        if(empty($params['title']) && !empty($params['status']) && !empty($params['row'])){
            $query = "select * from todos where user_id=1 and status=:status order by title ".$params['row'];
        } 
        return $query;
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

    // public function search(){
    //     $title = $_GET["title"];
    //     $status = $_GET["status"];


    //     if(isset($title) && !isset($status)){
    //         $sqlQuerys = "select * from todos where user_id=1 and title=:title";
    //     } 
    //     if(!isset($title) && isset($status)){
    //         $sqlQuerys = "select * from todos where user_id=1 and status=:status";
    //     } 
    //     if(isset($title) && isset($status)){
    //         $sqlQuerys = "select * from todos where user_id=1 and title=:title and status=:status";
    //     }

    //     $todo = Todo::findByQuery($sqlQuerys);
    //     if (empty($todo)) {
    //         header('Location: ../error/404.php');
    //     }
    //     return $todo;
    // }

    // public function sort(){
    //     $row = $_GET["row"];

    //     if($row === "asc"){
    //         $sqlQuerys = 'select * from todos order by title';
    //     } 
    //     if($row === "desc"){
    //         $sqlQuerys = 'select * from todos order by title desc';
    //     } 

    //     $todo = Todo::findByQuery($sqlQuerys);
    //     if (empty($todo)) {
    //         header('Location: ../error/404.php');
    //     }
    //     return $todo;
    // }

    public static function new(){
        session_start();//ession_start()の位置正しいか今度考える（sessionの値がないと出るため）

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $title = $_POST['title'];
            $detail = $_POST['detail'];
            $data = array(
                'title' => $title,
                'detail' => $detail
            );

            $validation = new TodoValidation;
            if(!$validation->check($title, $detail)){
                $_SESSION['errors'] = $validation->errors;
                header("Location: ../todos/new.php?"."title=".$data['title']."&detail=".$data['detail']);
                return;
            }

            if (!Todo::save($data)){
                header("Location: ../todos/new.php?"."title=".$data['title']."&detail=".$data['detail']);
            }

            header("Location: ../todos/index.php");
        }

        if(empty($_GET['title'])){
            $_GET['title']="";
        }
        if(empty($_GET['detail'])){
            $_GET['detail']="";
        }
        $title = $_GET['title'];
        $detail = $_GET['detail'];
        $data = array(
            'title' => $title,
            'detail' => $detail
        );
        return $data;
    }

    public static function edit(){
        session_start();

        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $title = $_POST['title'];
            $detail = $_POST['detail'];
            $todo_id = $_POST['todo_id'];
            $data = array(
                'title' => $title,
                'detail' => $detail,
                'todo_id' => $todo_id
            );

            $validation = new TodoValidation;
            if(!$validation->check($title, $detail)){
                $_SESSION['errors'] = $validation->errors;
                header("Location: ../todos/new.php?"."title=".$data['title']."&detail=".$data['detail']);
                return;
            }
            
            if (!Todo::update($data)){
                header("Location: ../todos/new.php?"."todo_id=".$data['todo_id']."&title=".$data['title']."&detail=".$data['detail']);
            }
            
            header("Location: ../todos/index.php");
            return $data;
        }

        $todo_id = $_GET['todo_id'];
        if(empty($todo_id)){
            header('Location: ../error/404.php');
        }

        $todo = Todo::findById($todo_id);
        if(empty($todo)){
            header('Location: ../error/404.php');
        }
        
    }

}







?>