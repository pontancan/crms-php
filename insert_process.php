<?php
// データベース接続情報を設定します
$host = 'localhost'; // XAMPP のデフォルトホスト
$dbname = 'crms_db'; // 使用するデータベース名
$username = 'root'; // MySQL のユーザー名
$password = ''; // MySQL のパスワード

try {
    // PDOインスタンスを作成し、データベースに接続します
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password);

    // エラーモードを例外に設定します
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // POSTデータを取得します
    $name = $_POST['name'];
    $kana = $_POST['kana'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $company_id = $_POST['company'];

    // SQL文を準備します
    $sql = "INSERT INTO customer (name, kana, email, phone, gender, dob, company_id, created_at, modified_at) 
             VALUES (:name, :kana, :email, :phone, :gender, :dob, :company_id, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";

    // SQL文を実行します
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

    // 成功メッセージを表示
    echo "顧客情報が正常に登録されました。";

    // 3秒待ってリダイレクト
    sleep(3);
    header('Location: list.php');
    exit();
} catch (PDOException $e) {
    // 接続失敗時のメッセージを表示します
    echo "データベース接続に失敗しました: " . $e->getMessage();
} finally {
    $pdo = null;
}
