<?php
require_once dirname(__FILE__) . '/lib/DBcon.php';
require_once dirname(__FILE__) . '/model/Company.php';
require_once dirname(__FILE__) . '/model/Customer.php';

// POSTデータを取得
$data = [
    'name' => $_POST['name'],
    'kana' => $_POST['kana'],
    'email' => $_POST['email'],
    'phone' => $_POST['phone'],
    'gender' => $_POST['gender'],
    'dob' => $_POST['dob'],
    'company_id' => $_POST['company']
];

try{
    $customer = new Customer();
    $customer->createCustomer($data);
    header('Location: list.php');

}catch (PDOException $e) {
    echo "データベース登録に失敗しました: " . $e->getMessage();
    echo "<p id='countdown'>5秒後にリストページにリダイレクトします...</p>";
    echo "<script>
            var countdownNumber = 3;
            var countdownElement = document.getElementById('countdown');
            var countdownInterval = setInterval(function() {
                countdownNumber--;
                countdownElement.textContent = countdownNumber + '秒後にリストページにリダイレクトします...';
                if (countdownNumber <= 0) {
                    clearInterval(countdownInterval);
                    window.location.href = 'list.php';
                }
            }, 1000);
          </script>";
    exit(); 
} finally {
    $pdo = null;
    
}


