<?php
require_once("../../models/Todo.php");
require_once("../../validations/TodoValidation.php");


class TodoController {
    public function index() {
        $title = $_GET['title'];
        $status = $_GET['status'];
        $row = $_GET['row'];
        
        if(!$_GET['title'] && !$_GET['row'] && !$_GET['status']){
            $todos = Todo::findAll();
        } else {
            $params = array(
                'title' => $title,
                'status' => $status,
                'row' => $row
            );
            $query = $this->buildQuery($params);
            $todos = Todo::findByQuery($query);
        }

        return $todos;
    }

    private function buildQuery($params){
        $query = 'select * from todos where user_id = 1';

        foreach($params as $key => $param){
            if($key === 'title' && !empty($param)){
                $query = $query.' and title=:title';
            }
            if($key === 'status' && !empty($param)){
                $query = $query . ' and status=:status';
            }
            if($key === 'row' && !empty($param)){
                $query = $query.' order by title '.$param;
            }
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