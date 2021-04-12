<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once '../../config/Database.php';
include_once '../../models/ExpenseModel.php';

$database = new Database();
$db = $database->connect();

$expenses = new Expense();
$data = json_decode(file_get_contents('php://input'));

$expenses->id = $data->id;

$expenses->amount = $data->amount;
$expenses->date = $data->date;
$expenses->category_id = $data->category_id;

if($expenses->update($db)){
    echo json_encode(
        array('message' => 'Updated data successfully!')
    );
} else{
    echo json_encode(
        array('message' => 'Failed update data!')
    );
}
?>