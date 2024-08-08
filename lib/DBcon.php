<?php
class DBcon
{
    private $host = 'localhost';
    private $dbname = 'crms_db';
    private $username = 'root';
    private $password = '';
    private $dsn;


    //他のprivateフィールドを使う場合、クラスがインスタンス化される前に初期化することができないためコンストラクタで初期化
    public function __construct()
    {
        $this->dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";
    }
    
    public function getDB(): PDO
    {
        $db = new PDO($this->dsn, $this->username, $this->password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }
}
