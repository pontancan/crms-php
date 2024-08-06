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



    $stt = $pdo->prepare('SELECT name FROM company');
    $stt->execute();
    while ($row = $stt->fetch(PDO::FETCH_ASSOC)) {
        
    }
} catch (PDOException $e) {

    echo "データベース接続に失敗しました: " . $e->getMessage();
} finally {
    $pdo = null;
}