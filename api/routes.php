<?php
require_once "./config/Connection.php";
require_once "./mainmodule/Get.php";
require_once "./mainmodule/Auth.php";
require_once "./mainmodule/Global.php";

$db = new Connection();
$pdo = $db->connect();
$global = new GlobalMethods($pdo);
$get = new Get($pdo);
$auth = new Auth($pdo);

if(isset($_REQUEST['request'])){
    $req = explode('/', rtrim($_REQUEST['request'], '/'));
}
else{
    $req = array("errorcatcher");
}

switch($_SERVER['REQUEST_METHOD']){
    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        switch($req[0]){

             // RESIDENTS ==================================
             // GET ALL OR SEARCH
            case 'residents':
                if(count($req)>1){
                    // SQL STATEMENT IF REQUEST IS residents/? is not null
                    // instead of rec number or id we are using it as LIKE
                    // for searching
                    echo json_encode($get->get_common('residents', "name LIKE '$req[1]%'"));
                }
                else{
                    // if null
                    echo json_encode($get->get_common('residents'));
                }   
            break;
              // COUNT ALL RESIDENTS
            case 'totalresidents':
                echo json_encode($get->get_count());
            break;
                // ADD RESIDENT
            case 'addresident':
                echo json_encode($global->insert('residents', $data));
            break;
                // UPDATE RESIDENT
            case 'updateresident':
                echo json_encode($global->update('residents', $data, NULL));
            break;
                // DELETE RESIDENT
            case 'deleteresident':
                if(count($req)>1){
                    echo json_encode($global->delete('residents', "id = '$req[1]'"));
                }
            break;
                // GET LAST ID OF RESIDENTS
            case 'getlastid':
                if(count($req)>1){
                    echo json_encode($get->get_last('students_tbl', "studnum_fld = '$req[1]'"));
                }
                else{
                    echo json_encode($get->get_last('students_tbl'));
                }   
            break;

            // CLEARANCE ==================================
                // GET ALL CLEANCE RECORDS
            case 'clearance':
                if(count($req)>1){
                    echo json_encode($get->get_common('clearance', "name LIKE '$req[1]%'"));
                }
                else{
                    echo json_encode($get->get_common('clearance'));
                }       
            break;  
                // ADD CLEARANCE
            case 'addclearance':
                echo json_encode($global->insert('clearance', $data));
            break;
                // UPDATE CLEARANCE
            case 'updateclearance':
                echo json_encode($global->update('clearance', $data, NULL));
            break;
                // DELETE CLEARANCE
            case 'deleteclearance':
                if(count($req)>1){
                    echo json_encode($global->delete('clearance', "id = '$req[1]'"));
                }
            break;
            // PERMIT ==================================
                // GET ALL PERMIT RECORDS
            case 'permit':
                if(count($req)>1){
                    echo json_encode($get->get_common('permit', "name LIKE '$req[1]%'"));
                }
                else{
                    echo json_encode($get->get_common('permit'));
                }       
            break;
                // ADD PERMIT
            case 'addpermit':
                echo json_encode($global->insert('permit', $data));
            break;
                // UPDATE PERMIT
            case 'updatepermit':
                echo json_encode($global->update('permit', $data, NULL));
            break;
                // DELETE PERMIT
            case 'deletepermit':
                if(count($req)>1){
                    echo json_encode($global->delete('permit', "id = '$req[1]'"));
                }
            break;
            // INDIGENCY ==================================
                // GET ALL INDIGENCY RECORDS
            case 'indigency':
                if(count($req)>1){
                    echo json_encode($get->get_common('indigency', "name LIKE '$req[1]%'"));
                }
                else{
                    echo json_encode($get->get_common('indigency'));
                }       
            break;
                // ADD INDIGENCY
             case 'addindigency':
                echo json_encode($global->insert('indigency', $data));
            break;
                // UPDATE INDIGENCY
            case 'updateindigency':
                echo json_encode($global->update('indigency', $data, NULL));
            break;
                // DELETE INDIGENCY
            case 'deleteindigency':
                if(count($req)>1){
                    echo json_encode($global->delete('indigency', "id = '$req[1]'"));
                }
            break;
             // ADD CLEARANCE ==================================
             case 'contact':
                echo json_encode($global->insert('contact', $data));
            break;
            // AUTH ==================================
                // REGISTER USER
            case 'register':
                echo json_encode($auth->register($data));
            break;
                // LOGIN USER
            case 'login':
                echo json_encode($auth->login($data));
            break;
            
            default:
                echo "request not found";
            break;
        }
    break;
    default:
        echo "failed request";
    break;

    
}