<?php
  //ステータス更新処理

  $todo_id = $_POST['todo_id'];
  $status = $_POST['status'];
  $data = array(
    'todo_id' => $todo_id,
    'status' => $status,
    'result' => "値が更新されました。"
  );

  require_once("../../controllers/TodoController.php");
  $todo = TodoController::updateStatus($data);

	header("Content-Type: application/json; charset=UTF-8");
  echo json_encode($data);

?>
