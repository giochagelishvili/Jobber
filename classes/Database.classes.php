<?php

class Database
{
    private string $username;
    private string $password;
    private string $host;
    private string $db;
    private $conn;

    public function __construct()
    {
        $this->username = "root";
        $this->password = "";
        $this->host = "localhost";
        $this->db = "jobber";

        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db", $this->username, $this->password);
        } catch (PDOException $e) {
            // Print out the error
            print "Error!: " . $e->getMessage() . "<br />";
            die();
        }
    }

    public function fetch(string $table, string $condition = '')
    {
        $sql = "SELECT * FROM $table";

        if ($condition != '') {
            $sql = "SELECT * FROM $table WHERE $condition";
        }

        $stmt = $this->conn->prepare($sql);

        if (!$stmt->execute()) {
            $this->conn = null;
            $stmt = null;
            exit();
        }

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function insert(string $table, array $values)
    {
        $sql = "INSERT INTO $table VALUES (";
        for ($i = 0; $i < sizeof($values) - 1; $i++) {
            $sql = $sql . "?, ";
        }
        $sql = $sql . "?);";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt->execute($values)) {
            $this->conn = null;
            $stmt = null;
            exit();
        }
    }

    public function delete(string $table, string $condition = '')
    {
        $sql = "DELETE FROM $table";

        if ($condition != '') {
            $sql = "DELETE FROM $table WHERE $condition";
        }

        $stmt = $this->conn->prepare($sql);

        if (!$stmt->execute()) {
            $this->conn = null;
            $stmt = null;
            exit();
        }

        return true;
    }
}
