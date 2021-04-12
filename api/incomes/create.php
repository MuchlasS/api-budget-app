<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once '../../config/Database.php';
include_once '../../models/IncomeModel.php';

$database = new Database();
$db = $database->connect();

$incomes = new Income();
$data = json_decode(file_get_contents('php://input'));

$incomes->amount = $data->amount;
$incomes->date = $data->date;
$incomes->category_id = $data->category_id;

if($incomes->create($db)){
    echo json_encode(
        array('message' => 'Created data successfully!')
    );
} else{
    echo json_encode(
        array('message' => 'Failed create data!')
    );
}
?>