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

        public function findByEmail($email){
            $sql = "SELECT * FROM users WHERE email = '$email'";

            $conn = Database::connect();
            $result = $conn->query($sql);

            $user = $result->fetch_assoc();
            return $user;
        }

        public function getById($id){
            $sql = "SELECT * FROM users WHERE id = '$id'";

            $conn = Database::connect();
            $result = $conn->query($sql);

            $user = $result->fetch_assoc();
            return $user;
        }

        public function getAllByRole($role){
            $sql = "SELECT * FROM users WHERE role = '$role'";

            $conn = Database::connect();
            $result = $conn->query($sql);

            $users = array();

            while($row = $result->fetch_assoc()){
                $users[] = $row;
            }

            return $users;
        }

        public function create($name, $email, $password, $role, $bio){
            $sql = "INSERT INTO users (name, email, password, role, bio) VALUES ('$name', '$email', '$password', '$role', '$bio')";
            $conn = Database::connect();
            $result = $conn->query($sql);

            if($result){
                return true;
            } else {
                return false;
            }
        }

        public function update($id, $name, $email, $password, $bio){
            $sql = "UPDATE users SET name = '$name', email = '$email', password = '$password', bio = '$bio' WHERE id = '$id'";
            $conn = Database::connect();
            $result = $conn->query($sql);

            if($result){
                return true;
            } else {
                return false;
            }
        }

        public function delete($id){
            $sql = "DELETE FROM users WHERE id = '$id'";
            $conn = Database::connect();
            $result = $conn->query($sql);

            if($result){
                return true;
            } else {
                return false;
            }
        }

    }

?>