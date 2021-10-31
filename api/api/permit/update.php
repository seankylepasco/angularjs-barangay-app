<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Acces-Control-Allow-Methods: PUT');
  header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-Type, Acces-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Permit.php';


  $database = new Database();
  $db = $database->connect();
  $permit = new Permit($db);

  $data = json_decode(file_get_contents("php://input"));

  $permit->id = $data->id;
  $permit->name = $data->name;
  $permit->address = $data->address;
  $permit->reason = $data->reason;

  if($permit->update()){
    echo json_encode(array('message' => 'Permit Updated'));
  }
  else{
    echo json_encode(array('message' => 'Permit Not Updated'));
  }
?>
