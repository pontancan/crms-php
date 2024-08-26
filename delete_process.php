<?php
// require_once dirname(__FILE__) . '/lib/DBcon.php';
require_once dirname(__FILE__) . '/model/Customer.php';
    // POSTデータを取得
    $customer_id = $_GET['customer_id'];
    //物理削除
    // $sql = "delete from customer where customer_id = :customer_id";

    try{
        $customer = new Customer();
        $customer -> logicalDelete($customer_id);
        header('Location: list.php');

    }catch(PDOException $e){
        echo "削除に失敗しました: " . $e->getMessage();
        exit();
    }

