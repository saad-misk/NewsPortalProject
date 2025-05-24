<?php
    require_once 'C:\xampp\htdocs\NewsPortal\config\databaseConfig.php';

    class User{
        public $id;
        public $name;
        public $email;
        public $password;
        public $bio;

        public function __construct($id = null, $name = null, $email = null, $password = null, $bio = null){
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
            $this->bio = $bio;
        }

        public function findByEmail($email) {
            $conn = Database::connect();
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            
            return $stmt->get_result()->fetch_assoc();
        }


        public function getById($id) {
            $conn = Database::connect();
            $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            
            return $stmt->get_result()->fetch_assoc();
        }

        public function getAllByRole($role) {
            $conn = Database::connect();
            $stmt = $conn->prepare("SELECT * FROM users WHERE role = ?");
            $stmt->bind_param('s', $role);
            $stmt->execute();
            
            $result = $stmt->get_result();
            $users = [];
            while($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
            return $users;
        }

        
        public function create($name, $email, $password, $role, $bio) {
            $conn = Database::connect();
            $stmt = $conn->prepare("
                INSERT INTO users 
                (name, email, password, role, bio) 
                VALUES (?, ?, ?, ?, ?)
            ");
            
            // Always hash passwords!
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            $stmt->bind_param(
                'sssss',
                $name,
                $email,
                $hashedPassword,
                $role,
                $bio
            );
            
            return $stmt->execute();
        }


        public function delete($id) {
            $conn = Database::connect();
            $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
            $stmt->bind_param('i', $id);
            return $stmt->execute();
        }

        public function update($id, $name, $email, $password, $bio) {
            $conn = Database::connect();
            $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, password = ?, bio = ? WHERE id = ?");
            $stmt->bind_param('sssss', $name, $email, $password, $bio, $id);    
            return $stmt->execute();
        }

    }

?>