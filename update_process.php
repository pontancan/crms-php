<?php
// データベース接続情報を設定します
$host = 'localhost'; // XAMPP のデフォルトホスト
$dbname = 'crms_db';
$username = 'root';
$password = '';

try {

    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password);

    // エラーモードを例外に設定
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // POSTデータを取得
    $customer_id = $_POST['customer_id'];
    $name = $_POST['name'];
    $kana = $_POST['kana'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $company_id = $_POST['company'];


    $sql = "UPDATE customer SET 
            name = :name, 
            kana = :kana, 
            email = :email, 
            phone = :phone, 
            gender = :gender, 
            dob = :dob, 
            company_id = :company_id, 
            modified_at = CURRENT_TIMESTAMP
            WHERE customer_id = :customer_id";


    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':kana' => $kana,
        ':email' => $email,
        ':phone' => $phone,
        ':gender' => $gender,
        ':dob' => $dob,
        ':company_id' => $company_id,
        ':customer_id' => $customer_id
    ]);



    header('Location: list.php');
    exit();
} catch (PDOException $e) {

    echo "データベース接続に失敗しました: " . $e->getMessage();
} finally {
    $pdo = null;
}
