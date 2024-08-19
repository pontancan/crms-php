        <?php
        require_once dirname(__FILE__) . '/lib/DBcon.php';
        require_once dirname(__FILE__) . '/model/Company.php';
        require_once dirname(__FILE__) . '/model/Customer.php';

        // POSTデータを取得
        $data = [
            'customer_id' => $_POST['customer_id'],
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
            $customer->updateCustomer($data);
    
            header('Location: list.php');

        }catch(PDOException $e){
            echo "データベースの更新に失敗しました: " . $e->getMessage();
            exit();
        }
