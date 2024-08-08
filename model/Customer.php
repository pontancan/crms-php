<?php
require_once dirname(__FILE__) . "/Model.php";
class Customer extends Model
{
    protected $table = 'customer';

    function getCustomers($params = [])//論理削除されていない顧客を持ってくる
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
        }catch (PDOException $e) {
            echo "データベース接続に失敗しました: " . $e->getMessage();
        } finally {
            $pdo = null;
        }
    }


    function selectCustomer($params)//指定されたidの顧客を持ってくる
    {
        try {
            $query = "SELECT * FROM {$this->table} WHERE customer_id = :customer_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':customer_id' => $params]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch (PDOException $e) {
            echo "データベース接続に失敗しました: " . $e->getMessage();
        } finally {
            $pdo = null;
        }
    }


}