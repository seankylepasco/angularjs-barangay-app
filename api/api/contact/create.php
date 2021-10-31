<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Acces-Control-Allow-Methods: POST');
  header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-Type, Acces-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Contact.php';

  $database = new Database();
  $db = $database->connect();
  $contact = new Contact($db);
  $data = json_decode(file_get_contents("php://input"));
  $contact->name = $data->name;
  $contact->email = $data->email;
  $contact->subject = $data->subject;
  $contact->mobile = $data->mobile;
  $contact->message = $data->message;

  if($contact->contact()){
    echo json_encode(array('message' => 'Message Sent!'));
  }
  else{
    echo json_encode(array('message' => 'Message not sent!'));
  } 
?>
