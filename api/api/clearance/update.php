<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Acces-Control-Allow-Methods: PUT');
  header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-Type, Acces-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Clearance.php';

  $database = new Database();
  $db = $database->connect();
  $clearance = new Clearance($db);
  $data = json_decode(file_get_contents("php://input"));
  $clearance->id = $data->id;
  $clearance->name = $data->name;
  $clearance->address = $data->address;
  $clearance->reason = $data->reason;

  if($clearance->update()){
    echo json_encode(array('message' => 'Post Updated'));
  }
  else{
    echo json_encode(array('message' => 'Post Not Updated'));
  }
?>
