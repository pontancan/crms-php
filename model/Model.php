<?php
require_once dirname(__FILE__) . '/../lib/DBcon.php';
class Model
{
    protected $pdo;
    protected $table;
    protected $primary;

    public function __construct()
    {
        $this->pdo = (new DBcon())->getDB();
    }

    public function select() {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
