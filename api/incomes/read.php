<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../../config/Database.php';
include_once '../../models/IncomeModel.php';

$database = new Database();
$db = $database->connect();

$income = new Income();

$result = $income->read($db);
$rowCount = $result->rowCount();

if($rowCount > 0){
    $incomes_arr = array();
    $incomes_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $incomes_item = array(
            'id' => $id,
            'amount' => $amount,
            'date' => $date,
            'category_id' => $category_id,
            'category_name' => $category_name
        );
        
        array_push($incomes_arr['data'], $incomes_item);
    }

    echo json_encode($incomes_arr);
} else{
    echo json_encode(
        array('message' => 'No Data Found')
    );
}
?>