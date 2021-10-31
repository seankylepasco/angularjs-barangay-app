<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  
  include_once '../../config/Database.php';
  include_once '../../models/Permit.php';

  $database = new Database();
  $db = $database->connect();
  $permit= new Permit($db);
  $result = $permit->read();
  $num = $result->rowCount();

  if($num > 0) {
    $arr = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $item = array(
        'id' => $id,
        'name' => $name,
        'address' => $address,
        'reason' => $reason,
        'created' => $created
      );
      array_push($arr, $item);
    }
    echo json_encode($arr);
  } 
  else {
    echo json_encode(array('message' => "Can't Find Anything"));
  }
