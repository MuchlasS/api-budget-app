<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once '../../config/Database.php';
include_once '../../models/ExpenseModel.php';

$database = new Database();
$db = $database->connect();

$expenses = new Expense();
$data = json_decode(file_get_contents('php://input'));

$expenses->id = $data->id;

if($expenses->delete($db)){
    echo json_encode(
        array('message' => 'Deleted data successfully!')
    );
} else{
    echo json_encode(
        array('message' => 'Failed delete data!')
    );
}
?>