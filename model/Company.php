<?php
require_once dirname(__FILE__) . "/Model.php";
class Company extends Model
{
    protected $table = 'company';

    function getCompanies()//会社idと名前を持ってくる
    {
        try {
            $stmt = $this->pdo->query("SELECT company_id, name FROM {$this->table}");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "データベース接続に失敗しました: " . $e->getMessage();
        } finally {
            $pdo = null;
        }
    }
}
