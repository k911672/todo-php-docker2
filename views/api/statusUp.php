<?php
  //ステータス更新処理
  require_once("../../controllers/TodoController.php");

  $todo_id = $_POST['todo_id'];
  $status = $_POST['status'];
  $data = array(
    'todo_id' => $todo_id,
    'status' => $status,
  );


  $result = TodoController::updateStatus($data);
  $response = array(
    'result' => $result['result'],
    'todo' => $result['todo'],
    'msg' => $result['msg']
  );

	header("Content-Type: application/json; charset=UTF-8");
  echo json_encode($response);

?>
