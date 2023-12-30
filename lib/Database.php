<?php

class Database {
    private $conn;

    public function __construct() {
        include_once '../config/database.php';
        $this->conn = $conn;
    }

    public function getConnection() {
        return $this->conn;
    }

    // Execute a query with parameters
    public function executeQuery($query, $params = []) {
        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            die("Error in query: " . $this->conn->error);
        }

        if (!empty($params)) {
            $types = str_repeat('s', count($params)); // Assuming all parameters are strings (change as needed)
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();

        if ($stmt->error) {
            die("Error executing query: " . $stmt->error);
        }

        return $stmt;
    }

    // Fetch a single row from the database
    public function fetchSingleRow($query, $params = []) {
        $stmt = $this->executeQuery($query, $params);
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    // Fetch multiple rows from the database
    public function fetchMultipleRows($query, $params = []) {
        $stmt = $this->executeQuery($query, $params);
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Insert data into the database
    public function insertData($table, $data) {
        $columns = implode(', ', array_keys($data));
        $values = implode(', ', array_fill(0, count($data), '?'));

        $query = "INSERT INTO $table ($columns) VALUES ($values)";
        $this->executeQuery($query, array_values($data));

        return $this->conn->insert_id;
    }

    // Update data in the database
    public function updateData($table, $data, $conditions) {
        $setClause = implode(', ', array_map(function ($column) {
            return "$column = ?";
        }, array_keys($data)));

        $whereClause = implode(' AND ', array_map(function ($column) {
            return "$column = ?";
        }, array_keys($conditions)));

        $query = "UPDATE $table SET $setClause WHERE $whereClause";
        $params = array_merge(array_values($data), array_values($conditions));

        $this->executeQuery($query, $params);
    }

    // Delete data from the database
    public function deleteData($table, $conditions) {
        $whereClause = implode(' AND ', array_map(function ($column) {
            return "$column = ?";
        }, array_keys($conditions)));

        $query = "DELETE FROM $table WHERE $whereClause";
        $this->executeQuery($query, array_values($conditions));
    }
}
?>
