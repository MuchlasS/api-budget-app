<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require_once '../../config/Database.php';
    include_once '../../models/BalanceModel.php';

    $database = new Database();
    $db = $database->connect();

    $balance = new Balance();

    $result = $balance->read($db);
    var_dump($result->rowCount());
    $rowCount = $result->rowCount();

    if($rowCount > 0){
        $balances_arr = array();
        $balances_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $balances_item = array(
                'id' => $id,
                'income_amount' => $income_amount,
                'expense_amount' => $expense_amount,
                'income_date' => $income_date,
                'expense_date' => $expense_date,
                'category_id' => $category_id,
                'category_name' => $category_name
            );

            array_push($balances_arr['data'], $balances_item);
        }

        echo json_encode($balances_arr);
    } else{
        echo json_encode(
            array('message' => 'No Data Found')
        );
    }
?>