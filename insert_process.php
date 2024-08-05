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

    // 接続成功時のメッセージを表示します
    echo "ハニー、データベース接続に成功しました。";
    var_dump($_POST);
} catch (PDOException $e) {
    // 接続失敗時のメッセージを表示します
    echo "データベース接続に失敗しました: " . $e->getMessage();
} finally{
    $pdo = null;
}
?>