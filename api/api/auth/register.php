<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Acces-Control-Allow-Methods: POST');
  header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-Type, Acces-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Auth.php';

  $database = new Database();
  $db = $database->connect();

  $post = new Auth($db);

  $data = json_decode(file_get_contents("php://input"));
  
  $post->name = $data->name;
  $post->email = $data->email;
  $post->password = password_hash($data->password, PASSWORD_DEFAULT);

  if($post->register()){
    echo json_encode(array('message' => 'User Created'));
  }
  else{
    echo json_encode(array('message' => 'User Not Created'));
  } 
?>