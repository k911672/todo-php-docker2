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
        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : '' ;
        $row = isset($_GET['row']) ? $_GET['row'] : '' ;

        if(empty($title) && empty($status) && empty($row)){
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

        $countTodo = count($todos);

        $page = 1;
        //最大ページ数の取得
        $maxPage = ceil($countTodo / Todo::LIMIT);
        //todoの総数の取得
        $total = $countTodo;

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
        $fromRecord = ($page - 1) * Todo::LIMIT + 1;
        if($page == $maxPage && $total % Todo::LIMIT !== 0) {
            $toRecord = ($page - 1) * Todo::LIMIT + $total % Todo::LIMIT;
        } else {
            $toRecord = $page * Todo::LIMIT;
        }

        $pageData = [
            'page' => $page,
            'maxPage' => $maxPage,
            '$total' => $total,
            'range' => $range,
            'fromRecord' => $fromRecord,
            'toRecord' => $toRecord,
        ];

        if($_SERVER['REQUEST_METHOD'] !== "GET"){
            header('Location: ../error/404.php');
        }

        //CSV ファイル作成
        if(isset($_GET['csv'])){
            $output_file = "../csv/test.csv";
            $dir = dirname($output_file);
            if(!file_exists($output_file)){
                mkdir($dir, 0700, true);
            }

            $fp_write = fopen($output_file, "w");
            $todos = Todo::findAll();
            $title = "";
            foreach ($todos as $key => $todo) {
                if($key === 0){
                    foreach ($todo as $column => $value) {
                        $title .= $column.",";
                    }
                    $title= rtrim($title, ",");
                    $title .= "\n";
                    fwrite($fp_write, $title);
                };
                fputcsv($fp_write, $todo);
            }
            fclose($fp_write);
        }

        return $data = [
            'todos' => $todos,
            'pageData' => $pageData
        ];
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

}

?>
