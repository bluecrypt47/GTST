<?php
class Database
{
    public $host = DB_HOST;
    public $user = DB_USER;
    public $pass = DB_PASS;
    public $dbname = DB_NAME;

    public $link;
    public $error;

    // Connect Database
    public function __construct()
    {
        $this->connectDB();
    }


    private function connectDB()
    {
        $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

        if (!$this->link) {
            $this->error = "Connection fail..." . $this->link->connect_error;
            return false;
        }
    }

    // Select or read DB
    public function select($query)
    {
        $resutl = $this->link->query($query) or die($this->link->error . __LINE__);

        if ($resutl->num_rows > 0) {
            return $resutl;
        } else {
            return false;
        }
    }

    // Add row DB
    public function insert($query)
    {
        $insert = $this->link->query($query) or die($this->link->error . __LINE__);

        if ($insert) {
            return $insert;
        } else {
            return false;
        }
    }

    // Update row DB
    public function upadte($query)
    {
        $upadte = $this->link->query($query) or die($this->link->error . __LINE__);

        if ($upadte) {
            return $upadte;
        } else {
            return false;
        }
    }

    // Delete row DB
    public function delete($query)
    {
        $delete = $this->link->query($query) or die($this->link->error . __LINE__);

        if ($delete) {
            return $delete;
        } else {
            return false;
        }
    }
}
