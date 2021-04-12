<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once '../../config/Database.php';
include_once '../../models/IncomeModel.php';

$database = new Database();
$db = $database->connect();

$incomes = new Income();
$data = json_decode(file_get_contents('php://input'));

$incomes->id = $data->id;

if($incomes->delete($db)){
    echo json_encode(
        array('message' => 'Deleted data successfully!')
    );
} else{
    echo json_encode(
        array('message' => 'Failed delete data!')
    );
}
?>