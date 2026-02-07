<?php
namespace User\WebDesa\Core;

use PDO;
use PDOException;

/**
 * Kelas wrapper database dengan PDO
 */
class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    
    private $dbh; // Database Handler
    private $stmt; // Statement
    
    public function __construct()
    {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        
        // Options
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        
        // Create instance
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch(PDOException $e) {
            die('Koneksi database gagal: ' . $e->getMessage());
        }
    }
    
    /**
     * Method untuk menulis query
     */
    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }
    
    /**
     * Method untuk binding parameter
     */
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        
        $this->stmt->bindValue($param, $value, $type);
    }
    
    /**
     * Method untuk eksekusi query
     */
    public function execute()
    {
        return $this->stmt->execute();
    }
    
    /**
     * Method untuk mengambil semua hasil
     */
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll();
    }
    
    /**
     * Method untuk mengambil satu hasil
     */
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch();
    }
    
    /**
     * Method untuk mendapatkan jumlah baris yang terpengaruh
     */
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}