<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Acces-Control-Allow-Methods: POST');
  header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-Type, Acces-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Clearance.php';

  $database = new Database();
  $db = $database->connect();
  $clearance = new Clearance($db);
  $data = json_decode(file_get_contents("php://input"));
  $clearance->name = $data->name;
  $clearance->address = $data->address;
  $clearance->reason = $data->reason;

  if($clearance->create()){
    echo json_encode(array('message' => 'Clearance Created'));
  }
  else{
    echo json_encode(array('message' => 'Clearance Not Created'));
  } 
?>
