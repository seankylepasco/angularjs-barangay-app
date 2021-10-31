<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Acces-Control-Allow-Methods: POST');
  header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-Type, Acces-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Residents.php';

  $database = new Database();
  $db = $database->connect();

  $post = new Post($db);

  $data = json_decode(file_get_contents("php://input"));

  if($data->civil_status === ""){
    $data->civil_status = "single";
  }
  if($data->voter_status === ""){
    $data->voter_status = "no";
  }
  if($data->birthdate === ""){
    $data->birthdate = "";
  }

  $post->name = $data->name;
  $post->email = $data->email;
  $post->address = $data->address;
  $post->birthdate = $data->birthdate;
  $post->gender = $data->gender;
  $post->purok = $data->purok;
  $post->voter_status = $data->voter_status;
  $post->civil_status = $data->civil_status;

  if($post->create()){
    echo json_encode(array('message' => 'Post Created'));
  }
  else{
    echo json_encode(array('message' => 'Post Not Created'));
  } 
?>
