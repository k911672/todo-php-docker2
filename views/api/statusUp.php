<?php
  //ステータス更新処理
  $status = $_GET['status'];
  $list = array("status" => $status);
  header("Content-type: application/json; charset=UTF-8");
  echo json_encode($list);
  exit;