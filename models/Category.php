<?php
    class Category{
        public $id;
        public $name;

        public function _construct($id = null, $name = null){
            $this->id = $id;
            $this->name = $name;
        }

        public function findByName($name){
            $sql = "SELECT * FROM categories WHERE name = '$name'";

            $conn = Database::connect();
            $result = $conn->query($sql);

            $category = $result->fetch_assoc();
            return $category;
        }

        public function getById($id){
            $sql = "SELECT * FROM categories WHERE id = '$id'";

            $conn = Database::connect();
            $result = $conn->query($sql);

            $category = $result->fetch_assoc();
            return $category;
        }

        public function getAll(){
            $sql = "SELECT * FROM categories";

            $conn = Database::connect();
            $result = $conn->query($sql);

            $categories = array();

            while($row = $result->fetch_assoc()){
                $categories[] = $row;
            }

            return $categories;
        }

        public function create($name){
            $sql = "INSERT INTO categories (name) VALUES ('$name')";
            $conn = Database::connect();
            $result = $conn->query($sql);

            if($result){
                return true;
            } else {
                return false;
            }
        }

        public function update($id, $name){
            $sql = "UPDATE categories SET name = '$name' WHERE id = '$id'";
            $conn = Database::connect();
            $result = $conn->query($sql);

            if($result){
                return true;
            } else {
                return false;
            }
        }

        public function delete($id){
            $sql = "DELETE FROM categories WHERE id = '$id'";
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