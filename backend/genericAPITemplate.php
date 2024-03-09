<?php
//Users route
require_once './db.php';
require_once './helperFunctions.php';
$db = new Database();
$table = 'users';

// Check access 
$request_method = $_SERVER['REQUEST_METHOD'];
if (true) { //here you should add your condition to check if the user is logged in and have the correct previlage 
    // If user is logged in and has the correct previlage, continue with the request 
    //ELSE redirect to login page and send a json object with the status + a msg
    // Assuming user is authorized and is an adminA
    if ($request_method === 'GET') {
        //check if $_GET is empty 
        $result;
        if (empty($_GET)) {
            $result = $db->readRecord($table);
        } else {
            $result = $db->readRecord($table, "id =" . $_GET['id']);
        }
        if ($result) {
            $status = "success";
            echo json_encode(array("status" => $status, "data" => $result));
        } else {
            setHeaderAndStatus(404, "No record found");
            exit;
        }
    } elseif ($request_method === 'POST') {
        $userData = array(
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => $_POST['password']
        );
        arrayKeyAndValueNotEpmty(($userData));
        $result = $db->createRecord($table, $userData);
        if ($result) {
            echo json_encode(array("status" => "success", "data" => $result));
        } else {
            setHeaderAndStatus(500, "Internal Server Error");
            exit;
        }
    } elseif ($request_method === 'PUT') {
        $put_vars = handlePutRequestData();
        $user_id = $put_vars['id'];
        unset($put_vars['id']); // to remove the id form the userdata coming from the putReq array
        $db->updateRecord($table, $put_vars, "id =" . $user_id);
    } elseif ($request_method === 'DELETE') {
        //user id is sent as a parameter in the URL
        $user_id = $_GET["id"];
        $db->deleteRecord($table, "id = " . $user_id);
        if ($db->conn->affected_rows > 0) {
            setHeaderAndStatus(200, "Successfully deleted");
        } else {
            setHeaderAndStatus(400, "No record found");
        }
    }
} else {
    setHeaderAndStatus(403, "Please login First");
}
