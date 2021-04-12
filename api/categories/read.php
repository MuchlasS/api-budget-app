<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../../config/Database.php';
include_once '../../models/CategoryModel.php';

$database = new Database();
$db = $database->connect();

$category = new Category();

$result = $category->read($db);
$rowCount = $result->rowCount();

if($rowCount > 0){
    $categories_arr = array();
    $categories_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $categories_item = array(
            'id' => $id,
            'name' => $name
        );
        
        array_push($categories_arr['data'], $categories_item);
    }

    echo json_encode($categories_arr);
} else{
    echo json_encode(
        array('message' => 'No Data Found')
    );
}
?>