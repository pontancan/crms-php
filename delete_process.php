<?php
require_once dirname(__FILE__) . '/lib/DBcon.php';
require_once dirname(__FILE__) . '/model/Customer.php';
    // POSTデータを取得
    $customer_id = $_GET['customer_id'];
    //物理削除
    // $sql = "delete from customer where customer_id = :customer_id";
    (new Customer()) -> logicalDeleteCustomer($customer_id);
    header('Location: list.php');
    exit();

