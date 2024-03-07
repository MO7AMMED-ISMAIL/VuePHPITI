<?php

class Database
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "os44";
    public $conn;

    // Constructor
    public function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die(json_encode( //sends json object with status and message
                array(
                    "status" => "Faile,Connection faliure",
                    "message" => "Connection failed: " . $this->conn->connect_error
                )
            ));
        }
    }

    // Create Record
    public function createRecord($tableName, $data)
    {
        $columns = implode(', ', array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $sql = "INSERT INTO $tableName ($columns) VALUES ($values)";
        return $this->conn->query($sql);
    }

    // Read Record
    public function readRecord($tableName, $condition = "")
    {
        $sql = "SELECT * FROM $tableName";
        if ($condition != "") {
            $sql .= " WHERE $condition";
        }
        $result = $this->conn->query($sql);
        $records = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $records[] = $row;
            }
        }
        return $records;
    }

    // Update Record
    public function updateRecord($tableName, $data, $condition)
    {
        $set = '';
        foreach ($data as $key => $value) {
            $set .= "$key = '$value', ";
        }
        $set = rtrim($set, ', ');
        $sql = "UPDATE $tableName SET $set WHERE $condition";
        return $this->conn->query($sql);
    }

    // Delete Record
    public function deleteRecord($tableName, $condition)
    {
        $sql = "DELETE FROM $tableName WHERE $condition";
        return $this->conn->query($sql);
    }

    // Destructor
    public function __destruct()
    {
        $this->conn->close();
    }
}

// Usage example:
/*
$db = new Database();

// Create Record
$data = array(
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'age' => 30
);
$db->createRecord('users', $data);

// Read Record
$users = $db->readRecord('users');
print_r($users);

// Update Record
$data = array(
    'name' => 'Jane Doe',
    'email' => 'jane@example.com',
    'age' => 25
);
$db->updateRecord('users', $data, "id = 1");

// Delete Record
$db->deleteRecord('users', "id = 1");
*/
