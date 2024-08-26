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

    public function LogicalDelete($id)
    {
        // プライマリキーに基づいてレコードを削除
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE {$this->primary} = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }


}
