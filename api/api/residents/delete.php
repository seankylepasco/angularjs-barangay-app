<?php
  // Headers.
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Acces-Control-Allow-Methods: DELETE');
  header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-Type, Acces-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Residents.php';

  // Instantiate Database & connect.
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog Post object.
  $post = new Post($db);
  // Get Raw Data.
  $data = json_decode(file_get_contents("php://input"));
  // Set The ID.
  $post->id = $data->id;

  // Delete Post.
  if($post->delete()){
    echo json_encode(array('message' => 'Post Deleted'));
  }
  else{
    echo json_encode(array('message' => 'Post Not Deleted'));
  }
?>
