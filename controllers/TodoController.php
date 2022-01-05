<?php
require_once("../../models/Todo.php");
require_once("../../validations/TodoValidation.php");

class TodoController {
    public function __construct() {
        session_start();
        if(empty($_SESSION['user']['id'])){
            header('Location: ../user/login.php');
        }
    }

    public function index() {
        $title = $_GET['title'];
        $status = $_GET['status'];
        $row = $_GET['row'];//空の時どうするか？

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
        $query = 'select * from todos where user_id = 1 and delete_at is null';

        //SQLインジェクション考える。
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
        session_start();
        if(empty($_SESSION['user']['id'])){
            header('Location: ../user/login.php');
        }

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $title = $_POST['title'];
            $detail = $_POST['detail'];
            $status = $_POST['status'];
            $data = array(
                'title' => $title,
                'detail' => $detail,
                'status' => $status,
            );

            $validation = new TodoValidation;
            if(!$validation->check($title, $detail)){
                $_SESSION['errors'] = $validation->errors;
                header("Location: ../todos/new.php?"."title=".$data['title']."&detail=".$data['detail']."&status=1");
                return;
            }

            if (!Todo::save($data)){
                header("Location: ../todos/new.php?"."title=".$data['title']."&detail=".$data['detail']."&status=1");
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
        $status = $_GET['status'];
        $data = array(
            'title' => $title,
            'detail' => $detail,
            'status' => $status
        );
        return $data;
    }

    public static function edit(){
        session_start();
        if(empty($_SESSION['user']['id'])){
            header('Location: ../user/login.php');
        }

        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $title = $_POST['title'];
            $detail = $_POST['detail'];
            $todo_id = $_POST['todo_id'];
            $data = array(
                'title' => $title,
                'detail' => $detail,
                'todo_id' => $todo_id,
            );

            $validation = new TodoValidation;
            if(!$validation->check($title, $detail)){
                $_SESSION['errors'] = $validation->errors;
                header("Location: ../todos/edit.php?"."title=".$data['title']."&detail=".$data['detail']);
                return;
            }

            if (!Todo::update($data)){
                header("Location: ../todos/edit.php?"."todo_id=".$data['todo_id']."&title=".$data['title']."&detail=".$data['detail']);
            }

            header("Location: ../todos/index.php");
            return $data;
        }

        $title = $_GET['title'];
        $detail = $_GET['detail'];
        $todo_id = $_GET['todo_id'];
        $data = array(
            'title' => $title,
            'detail' => $detail,
            'todo_id' => $todo_id
        );
        if(empty($data['todo_id'])){
            header('Location: ../error/404.php');
        }

        $todo = Todo::findById($todo_id);
        if(empty($todo)){
            header('Location: ../error/404.php');
        }
        return $data;
    }

    public static function changePage(){
        $countTodo = Todo::count();

        $page = 1;
        //最大ページ数の取得
        // $maxPage = ceil($countTodo['cnt'] / 5);
        $maxPage = ceil($countTodo['cnt'] / 1);
        //todoの総数の取得
        $allTodo = $countTodo['cnt'];

        //$_GET['page']に値がなければ1ページとする
        if(isset($_GET['page']) && is_numeric($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        //表示させるページ範囲の指定
        if($page == 1 || $page == $maxPage) {
            $range = 4;
        } elseif ($page == 2 || $page == $maxPage - 1) {
            $range = 3;
        } else {
            $range = 2;
        }

        //○件目と表示
        $fromRecord = ($page - 1) * 5 + 1;
        if($page == $maxPage && $allTodo % 5 !== 0) {
            $toRecord = ($page - 1) * 5 + $allTodo % 5;
        } else {
            $toRecord = $page * 5;
        }

        $pageData = [
            'page' => $page,
            'maxPage' => $maxPage,
            '$allTodo' => $allTodo,
            'range' => $range,
            'fromRecord' => $fromRecord,
            'toRecord' => $toRecord,
        ];

        return $pageData;
    }

}







?>
