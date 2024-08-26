<?php
require_once dirname(__FILE__) . "/Model.php";
class Customer extends Model
{
    protected $table = 'customer';
    protected $primary = 'customer_id';

    public function __construct()
    {
        parent::__construct();
    }

    function getCustomers($params = []) //論理削除されていない顧客を持ってくる

    {
        $query = "SELECT customer.*, company.name AS company_name FROM {$this->table} LEFT JOIN company ON customer.company_id = company.company_id WHERE customer.deleted_at IS NULL";

        if (!empty($params[':name'])) {
            $query .= ' AND customer.name LIKE :name';
        }
        if (!empty($params[':kana'])) {
            $query .= ' AND customer.kana LIKE :kana';
        }
        if (!empty($params[':gender']) && $params[':gender'] != 'all') {
            $query .= ' AND customer.gender = :gender';
        }
        if (!empty($params[':dob_start'])) {
            $query .= ' AND customer.dob >= :dob_start';
        }
        if (!empty($params[':dob_end'])) {
            $query .= ' AND customer.dob <= :dob_end';
        }
        if (!empty($params[':company']) && $params[':company'] != 'all') {
            $query .= ' AND customer.company_id = :company';
        }

        if (!empty($_GET['sort']) && !empty($_GET['order'])) {
            $sort = $_GET['sort'];
            $order = strtoupper($_GET['order']) === 'ASC' ? 'ASC' : 'DESC';
    
            // 更新日時での並び替え
            if ($sort == 'modified_at') {
                $query .= " ORDER BY customer.modified_at $order";
            } else {
                // その他のソート条件
                $validSortColumns = ['customer_id', 'created_at'];
                if (in_array($sort, $validSortColumns)) {
                    $query .= " ORDER BY $sort $order";
                }
            }
        } else {
            // デフォルトの並び順を設定
            $query .= " ORDER BY customer.customer_id ASC";
        }

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    function selectCustomer($params) //指定されたidの顧客を持ってくるprimary外だし
    {
        $query = "SELECT * FROM {$this->table} WHERE customer_id = :customer_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':customer_id' => $params]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }




    function updateCustomer($data)
    {
        $sql = "UPDATE {$this->table} SET 
        name = :name, 
        kana = :kana, 
        email = :email, 
        phone = :phone, 
        gender = :gender, 
        dob = :dob, 
        company_id = :company_id, 
        modified_at = CURRENT_TIMESTAMP
        WHERE customer_id = :customer_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name' => $data['name'],
            ':kana' => $data['kana'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':gender' => $data['gender'],
            ':dob' => $data['dob'],
            ':company_id' => $data['company_id'],
            ':customer_id' => $data['customer_id']
        ]);
    }

    function createCustomer($data)
    {
        $sql = "INSERT INTO {$this->table} (name, kana, email, phone, gender, dob, company_id) 
            VALUES (:name, :kana, :email, :phone, :gender, :dob, :company_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name' => $data['name'],
            ':kana' => $data['kana'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':gender' => $data['gender'],
            ':dob' => $data['dob'],
            ':company_id' => $data['company_id']
        ]);
    }

    function logicalDeleteCustomer($data) //指定されたidの顧客を論理的に削除するprimaryで共通化させる
    {
        $query = "UPDATE {$this->table} SET deleted_at = CURRENT_TIMESTAMP WHERE customer_id = :customer_id";;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':customer_id' => $data]);
    }
}
