<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Acces-Control-Allow-Methods: GET, POST');
  header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-Type, Acces-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Auth.php';

  $database = new Database();
  $db = $database->connect();

  $auth = new auth($db);

  $data = json_decode(file_get_contents("php://input"));
  
  $auth->email = $data->email;
  $auth->password = $data->password;

  $result = $auth->login();
  $num = $result->rowCount();

  if($num > 0) {
    $test_arr =array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $verify = password_verify($data->password, $row['password']);
      if($verify){
        array_push($test_arr, $row);
      }
      else{
        array_push($test_arr,  array('message' => 'No users Found'));
      }
    }
    echo json_encode($test_arr);
  } else {
    echo json_encode(
      array('message' => 'No users Found')
    );
  }

?>
