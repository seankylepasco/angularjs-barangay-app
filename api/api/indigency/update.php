<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Acces-Control-Allow-Methods: PUT');
  header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-Type, Acces-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Indigency.php';


  $database = new Database();
  $db = $database->connect();
  $indigency = new Indigency($db);
  $data = json_decode(file_get_contents("php://input"));
  $indigency->id = $data->id;
  $indigency->name = $data->name;
  $indigency->address = $data->address;
  $indigency->reason = $data->reason;

  if($indigency->update()){
    echo json_encode(array('message' => 'Post Updated'));
  }
  else{
    echo json_encode(array('message' => 'Post Not Updated'));
  }
?>
