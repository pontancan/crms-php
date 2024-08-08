<?php
require_once dirname(__FILE__) . "/Model.php";
class Customer extends Model
{
    protected $table = 'customer';

    function getCustomers($params = []) //論理削除されていない顧客を持ってくる
    {
        try {
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

            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "データベース接続に失敗しました: " . $e->getMessage();
        } finally {
            $pdo = null;
        }
    }


    function selectCustomer($params) //指定されたidの顧客を持ってくる
    {
        try {
            $query = "SELECT * FROM {$this->table} WHERE customer_id = :customer_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':customer_id' => $params]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "データベース接続に失敗しました: " . $e->getMessage();
        } finally {
            $pdo = null;
        }
    }

    function updateCustomer($data)
    {
        try {
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
        } catch (PDOException $e) {
            echo "データベース接続に失敗しました: " . $e->getMessage();
        } finally {
            $pdo = null;
        }
    }

    function createCustomer($data)
    {
        try {
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
        } catch (PDOException $e) {
            echo "データベース接続に失敗しました: " . $e->getMessage();
        } finally {
            $pdo = null;
        }
    }

    function logicalDeleteCustomer($data) //指定されたidの顧客を論理的に削除する
    {
        try {
            $query = "UPDATE {$this->table} SET deleted_at = CURRENT_TIMESTAMP WHERE customer_id = :customer_id";;
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':customer_id' => $data]);
        } catch (PDOException $e) {
            echo "データベース接続に失敗しました: " . $e->getMessage();
        } finally {
            $pdo = null;
        }
    }
}
