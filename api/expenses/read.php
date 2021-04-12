<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../../config/Database.php';
include_once '../../models/ExpenseModel.php';

$database = new Database();
$db = $database->connect();

$expense = new Expense();

$result = $expense->read($db);
$rowCount = $result->rowCount();

if($rowCount > 0){
    $expenses_arr = array();
    $expenses_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $expenses_item = array(
            'id' => $id,
            'amount' => $amount,
            'date' => $date,
            'category_id' => $category_id,
            'category_name' => $category_name
        );
        
        array_push($expenses_arr['data'], $expenses_item);
    }

    echo json_encode($expenses_arr);
} else{
    echo json_encode(
        array('message' => 'No Data Found')
    );
}
?>