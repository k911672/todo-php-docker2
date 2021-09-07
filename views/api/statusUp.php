<?php
  //ステータス更新処理
  require_once("../../controllers/TodoController.php");
  // $todoController = new TodoController;
  // $todos = $todoController->updateStatus();
  $todo_id = $_POST['todo_id'];
  $status = $_POST['status'];
  $data = array(
      'todo_id' => $todo_id,
      'status' => $status
  );
  $todo = TodoController::updateStatus($data);
  $response = array(
    // "result" => $todo['status'],
    "result" => $_POST['status'],
    "msg" => "値が更新されませんでした。"
  );
  header("Content-type: application/json; charset=UTF-8");
  echo json_encode($response, JSON_UNESCAPED_UNICODE);

?>
