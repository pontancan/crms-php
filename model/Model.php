<?php
require_once dirname(__FILE__) . '/../lib/DBcon.php';
class Model{
    protected  $pdo;
    protected  $table;
    protected $primary;

    public function __construct() {
        $this->pdo = (new DBcon()) -> getDB();
    }
}
?>