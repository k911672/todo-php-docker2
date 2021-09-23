<?php
require_once("../../models/Todo.php");
require_once("../../validations/TodoValidation.php");

class TodoController {
    public static function updateStatus($data){
        if($data['status'] !== Todo::STATUS_INCOMPLETE){
            if($data['status'] !== Todo::STATUS_COMPLETE){
                return array(
                    'result' => "fail",
                    'todo' => $data,
                    'msg' => "ステータスが不正です。"
                );
            }
        }
        if(!is_numeric($data['todo_id']) ){
            return array(
                'result' => "fail",
                'todo' => $data,
                'msg' => "idが不正です。"
            );
        }

        $result = Todo::updateStatus($data);

        if($result){
            return array(
                'result' => "success",
                'todo' => $data,
                'msg' => "更新が成功しました。"
            );
        }
        return array(
            'result' => "fail",
            'todo' => $data,
            'msg' => "更新に失敗しました。"
        );
    }

    public static function deleteTodo($data){
        if($data['delete_at'] !== Todo::DELETE_INCOMPLETE){
            if($data['delete_at'] !== Todo::DELETE_COMPLETE){
                return array(
                    'result' => "fail",
                    'todo' => $data,
                    'msg' => "ステータスが不正です。"
                );
            }
        }
        if(!is_numeric($data['todo_id']) ){
            return array(
                'result' => "fail",
                'todo' => $data,
                'msg' => "idが不正です。"
            );
        }

        $result = Todo::deleteTodo($data);

        if($result){
            return array(
                'result' => "success",
                'todo' => $data,
                'msg' => "Todoを削除しました。"
            );
        }
        return array(
            'result' => "fail",
            'todo' => $data,
            'msg' => "Todoの削除が失敗しました。"
        );
    }
}


?>
