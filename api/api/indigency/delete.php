<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Acces-Control-Allow-Methods: DELETE');
  header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-Type, Acces-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Indigency.php';

  $database = new Database();
  $db = $database->connect();
  $indigency = new Indigency($db);

  $data = json_decode(file_get_contents("php://input"));
  $indigency->id = $data->id;

  if($indigency->delete()){
    echo json_encode(array('message' => 'Indigency Deleted'));
  }
  else{
    echo json_encode(array('message' => 'Indigency Not Deleted'));
  }
?>
