<?php
require_once 'C:\xampp\htdocs\NewsPortal\config\databaseConfig.php';
class News {
    public $id;
    public $title;
    public $content;
    public $author_id;
    public $category_id;
    public $thumbnail_url;
    public $views;
    public $created_at;
    public $is_featured;
    public $status;

    public function __construct($id = null, $title = null, $content = null, $author_id = null, $category_id = null, $thumbnail_url = null, $views = 0, $created_at = null, $is_featured = false, $status = 'pending') {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->author_id = $author_id;
        $this->category_id = $category_id;
        $this->thumbnail_url = $thumbnail_url;
        $this->views = $views;
        $this->created_at = $created_at;
        $this->is_featured = $is_featured;
        $this->status = $status;
    }

    public function getById($id){
        $sql = "SELECT * FROM news WHERE id = '$id'";

        $conn = Database::connect();
        $result = $conn->query($sql);

        $user = $result->fetch_assoc();
        return $user;
    }

    public function getAll(){
        $sql = "SELECT news.*, categories.name AS category_name, users.name AS author_name 
                FROM news
                JOIN categories ON news.category_id = categories.id
                JOIN users ON news.author_id = users.id
                ORDER BY news.created_at DESC";

        $conn = Database::connect();
        $result = $conn->query($sql);

        $news = array();

        while($row = $result->fetch_assoc()){
            $news[] = $row;
        }

        return $news;
    }

    public function create($data){
        $sql = "INSERT INTO news (title, content, category_id, author_id, thumbnail_url, views, is_featured)
                VALUES (
                    '" . $data["title"] . "',
                    '" . $data["content"] . "',
                    " . $data["category_id"] . ",
                    " . $data["author_id"] . ",
                    '" . $data["thumbnail_url"] . "',
                    " . $data["views"] . ",
                    " . $data["is_featured"] . "
                )";
        $conn = Database::connect();
        $result = $conn->query($sql);

        if($result){
            return true;
        } else {
            return false;
        }
    }

    public function delete($id){
        $sql = "DELETE FROM news WHERE id = $id";

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
}
?>
