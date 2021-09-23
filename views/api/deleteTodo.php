<?php
  require_once("../../controllers/api/TodoController.php");

  $todo_id = $_POST['todo_id'];
  $delete_at = $_POST['delete_at'];
  $data = array(
    'todo_id' => $todo_id,
    'delete_at' => $delete_at,
  );

  $result = TodoController::deleteTodo($data);
  $response = array(
    'result' => $result['result'],
    'todo' => $result['todo'],
    'msg' => $result['msg']
  );

	header("Content-Type: application/json; charset=UTF-8");
  echo json_encode($response);

?>
