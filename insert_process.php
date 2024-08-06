<?php

$host = 'localhost'; // XAMPP のデフォルトホストを指定する
$dbname = 'crms_db'; 
$username = 'root';
$password = ''; 

try {
    
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password);

    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // POSTデータを取得
    $name = $_POST['name'];
    $kana = $_POST['kana'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $company_id = $_POST['company'];

    //名前付きぱらで
    $sql = "INSERT INTO customer (name, kana, email, phone, gender, dob, company_id) 
             VALUES (:name, :kana, :email, :phone, :gender, :dob, :company_id)";

    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':kana' => $kana,
        ':email' => $email,
        ':phone' => $phone,
        ':gender' => $gender,
        ':dob' => $dob,
        ':company_id' => $company_id
    ]);

    

   //3秒まつ
    // sleep(3);
    header('Location: list.php');
    exit();
} catch (PDOException $e) {
    
    echo "データベース接続に失敗しました: " . $e->getMessage();
} finally {
    //一応接続を切る
    $pdo = null;
}
