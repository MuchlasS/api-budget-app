<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once '../../config/Database.php';
include_once '../../models/CategoryModel.php';

$database = new Database();
$db = $database->connect();

$categories = new Category();
$data = json_decode(file_get_contents('php://input'));

$categories->name = $data->name;

if($categories->create($db)){
    echo json_encode(
        array('message' => 'Created data successfully!')
    );
} else{
    echo json_encode(
        array('message' => 'Failed create data!')
    );
}
?>