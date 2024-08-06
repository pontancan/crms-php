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
    $customer_id = $_POST['customer_id'];
    $name = $_POST['name'];
    $kana = $_POST['kana'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $company_id = $_POST['company'];

    // SQL文を準備します
    $sql = "UPDATE customer SET 
            name = :name, 
            kana = :kana, 
            email = :email, 
            phone = :phone, 
            gender = :gender, 
            dob = :dob, 
            company_id = :company_id
            WHERE customer_id = :customer_id";

    // SQL文を実行します
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

    // 成功メッセージを表示
    // echo "顧客情報が正常に更新されました。";

    header('Location: list.php');
    exit();

} catch (PDOException $e) {
    // 接続失敗時のメッセージを表示します
    echo "データベース接続に失敗しました: " . $e->getMessage();
} finally {
    $pdo = null;
}
?>
