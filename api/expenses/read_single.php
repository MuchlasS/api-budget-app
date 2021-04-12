<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../../config/Database.php';
include_once '../../models/ExpenseModel.php';

$database = new Database();
$db = $database->connect();

$expenses = new Expense();

$expenses->id = isset($_GET['id']) ? $_GET['id'] : die();
$expenses->read_single($db);
$expenses_arr = array(
    'id' => $expenses->id,
    'amount' => $expenses->amount,
    'date' => $expenses->date,
    'category_id' => $expenses->category_id,
    'category_name' => $expenses->category_name
);
print_r(json_encode($expenses_arr));
?>