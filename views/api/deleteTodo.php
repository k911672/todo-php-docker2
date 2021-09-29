<?php
  require_once("../../controllers/api/TodoController.php");

  $todo_id = $_POST['todo_id'];
  $data = array(
    'todo_id' => $todo_id,
  );

  $result = TodoController::delete($data);
  $response = array(
    'result' => $result['result'],
    'msg' => $result['msg']
  );

	header("Content-Type: application/json; charset=UTF-8");
  echo json_encode($response);

?>
