<?php
  //ステータス更新処理

  // $todoController = new TodoController;
  // $todos = $todoController->updateStatus();

  $todo = TodoController::updateStatus();
  $response = array(
    "result" => $todo['status'],
    "msg" => "値が更新されませんでした。"
  );
  header("Content-type: application/json; charset=UTF-8");
  echo json_encode($response, JSON_UNESCAPED_UNICODE);

?>