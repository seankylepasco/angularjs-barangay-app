<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
include_once '../../config/Database.php';
include_once '../../models/Indigency.php';

  
$database = new Database();
$db = $database->connect();
$indigency = new Indigency($db);
$data = json_decode(file_get_contents("php://input"));
$keywords = $data->search_query;
$stmt = $indigency->search($keywords);
$num = $stmt->rowCount();
if($num>0){
    $arr=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $item=array(
            'id' => $id,
            'name' => $name,
            'reason' => $reason,
            'address' => $address,
            'created' => $created
        );
        array_push($arr, $item);
    }
    http_response_code(200);
    echo json_encode($arr);
}
else{
    echo json_encode(
        array("message" => "Can't Find Anything.")
    );
}
?>