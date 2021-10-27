<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
include_once '../../config/Database.php';
include_once '../../models/Residents.php';
  
$database = new Database();
$db = $database->connect();
$product = new Post($db);
$data = json_decode(file_get_contents("php://input"));
$keywords = $data->search_query;
$stmt = $product->search($keywords);
$num = $stmt->rowCount();
if($num>0){
    $post_array=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $post_item=array(
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'birthdate' => $birthdate,
            'address' => $address,
            'voter_status' => $voter_status,
            'civil_status' => $civil_status
        );
        array_push($post_array, $post_item);
    }
    http_response_code(200);
    echo json_encode($post_array);
}
else{
    echo json_encode(
        array("message" => "No Data found.")
    );
}
?>