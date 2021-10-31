<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Acces-Control-Allow-Methods: DELETE');
  header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-Type, Acces-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Permit.php';

  $database = new Database();
  $db = $database->connect();
  $permit = new Permit($db);

  $data = json_decode(file_get_contents("php://input"));
  $permit->id = $data->id;

  if($permit->delete()){
    echo json_encode(array('message' => 'Permit Deleted'));
  }
  else{
    echo json_encode(array('message' => 'Permit Not Deleted'));
  }
?>
