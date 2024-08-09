<?php
require_once dirname(__FILE__) . "/Model.php";
class Company extends Model
{
    protected $table = 'company';

    function getCompanies() //会社idと名前を持ってくる
    {
        $stmt = $this->pdo->query("SELECT company_id, name FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
