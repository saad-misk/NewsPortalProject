<?php
require_once 'C:\xampp\htdocs\NewsPortal\config\databaseConfig.php';

class Category {
    public $id;
    public $name;

    public function __construct($id = null, $name = null) { // Fixed constructor name
        $this->id = $id;
        $this->name = $name;
    }

    public function findByName($name) {
        $conn = Database::connect();
        $stmt = $conn->prepare("SELECT * FROM categories WHERE name = ?");
        $stmt->bind_param('s', $name);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getById($id) {
        $conn = Database::connect();
        $stmt = $conn->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getAll() {
        $conn = Database::connect();
        $result = $conn->query("SELECT * FROM categories");
        $categories = [];
        while($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
        return $categories;
    }

    public function create($name) {
        $conn = Database::connect();
        $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->bind_param('s', $name);
        return $stmt->execute();
    }

    public function update($id, $name) {
        $conn = Database::connect();
        $stmt = $conn->prepare("UPDATE categories SET name = ? WHERE id = ?");
        $stmt->bind_param('si', $name, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $conn = Database::connect();
        $stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
?>