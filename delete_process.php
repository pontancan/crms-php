<?php
$host = 'localhost'; // XAMPP のデフォルトホスト
$dbname = 'crms_db';
$username = 'root';
$password = '';

try {

    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password);

    // エラーモードを例外に
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // POSTデータを取得
    $customer_id = $_GET['customer_id'];
    

    //名前付きぱらで
    $sql = "delete from customer where customer_id = :customer_id";

    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':customer_id' => $customer_id
    ]);

    

   //3秒まつ
    // sleep(3);
    header('Location: list.php');
    exit();

} catch (PDOException $e) {

    echo "データベース接続に失敗しました: " . $e->getMessage();
} finally {
    $pdo = null;
}