<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../../config/Database.php';
include_once '../../models/CategoryModel.php';

$database = new Database();
$db = $database->connect();

$categories = new Category();

$categories->id = isset($_GET['id']) ? $_GET['id'] : die();
$categories->read_single($db);
$categories_arr = array(
    'id' => $categories->id,
    'name' => $categories->name
);
print_r(json_encode($categories_arr));
?>