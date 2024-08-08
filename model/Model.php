<?php

class Model{
    protected  $pdo;
    protected  $table;

    public function __construct() {
        $this->pdo = (new DBcon()) -> getDB();
    }
}
?>