<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Acces-Control-Allow-Methods: DELETE');
  header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-Type, Acces-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Residents.php';

  $database = new Database();
  $db = $database->connect();
  $post = new Post($db);

  $data = json_decode(file_get_contents("php://input"));
  $post->id = $data->id;

  if($post->delete()){
    echo json_encode(array('message' => 'Post Deleted'));
  }
  else{
    echo json_encode(array('message' => 'Post Not Deleted'));
  }
?>
