<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../../config/Database.php';
include_once '../../models/IncomeModel.php';

$database = new Database();
$db = $database->connect();

$income = new Income();

$income->id = isset($_GET['id']) ? $_GET['id'] : die();
$income->read_single($db);
$income_arr = array(
    'id' => $income->id,
    'amount' => $income->amount,
    'date' => $income->date,
    'category_id' => $income->category_id,
    'category_name' => $income->category_name
);
print_r(json_encode($income_arr));
?>