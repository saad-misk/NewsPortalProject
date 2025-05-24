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

    public function getById($id) {
        $conn = Database::connect();
        $stmt = $conn->prepare("
            SELECT news.*, categories.name AS category_name
            FROM news
            JOIN categories ON news.category_id = categories.id
            WHERE news.id = ?
        ");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getAll() {
        $conn = Database::connect();
        $stmt = $conn->prepare("
            SELECT news.*, categories.name AS category_name, users.name AS author_name 
            FROM news
            JOIN categories ON news.category_id = categories.id
            JOIN users ON news.author_id = users.id
            WHERE status = 'approved'
            ORDER BY news.created_at DESC
        ");
        $stmt->execute();
        $result = $stmt->get_result();
        $news = [];
        while($row = $result->fetch_assoc()) {
            $news[] = $row;
        }
        return $news;
    }

    public function getByCategory($category_id) {
        $conn = Database::connect();
        $stmt = $conn->prepare("
            SELECT news.*, categories.name AS category_name, users.name AS author_name 
            FROM news
            JOIN categories ON news.category_id = categories.id
            JOIN users ON news.author_id = users.id
            WHERE category_id = ? AND status = 'approved'
            ORDER BY news.created_at DESC
        ");
        $stmt->bind_param('i', $category_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $news = [];
        while($row = $result->fetch_assoc()) {
            $news[] = $row;
        }
        return $news;
    }

    public function getByAuthor($author_id) {
        $conn = Database::connect();
        $stmt = $conn->prepare("
            SELECT news.*, categories.name AS category_name, users.name AS author_name 
            FROM news
            JOIN categories ON news.category_id = categories.id
            JOIN users ON news.author_id = users.id
            WHERE author_id = ? AND status = 'approved'
            ORDER BY news.created_at DESC
        ");
        $stmt->bind_param('i', $author_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $news = [];
        while($row = $result->fetch_assoc()) {
            $news[] = $row;
        }
        return $news;
    }

    public function getNotApproved() {
        $conn = Database::connect();
        $stmt = $conn->prepare("
            SELECT news.*, categories.name AS category_name, users.name AS author_name 
            FROM news
            JOIN categories ON news.category_id = categories.id
            JOIN users ON news.author_id = users.id
            WHERE status != 'approved'
            ORDER BY news.created_at DESC
        ");
        $stmt->execute();
        $result = $stmt->get_result();
        $news = [];
        while($row = $result->fetch_assoc()) {
            $news[] = $row;
        }
        return $news;
    }

    public function getFeaturedNews($limit = 5) {

        $sql = "SELECT news.*, categories.name AS category_name
                FROM news
                JOIN categories ON news.category_id = categories.id
                WHERE is_featured = 1 AND status = 'approved'
                ORDER BY news.created_at DESC
                LIMIT ?";

        $conn = Database::connect();

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        $newsItems = [];

        while ($row = $result->fetch_assoc()) {
            $newsItems[] = $row;
        }

        $stmt->close();
        return $newsItems;
    }

    public function getMostRead($limit = 5) {

        $sql = "SELECT news.*, categories.name AS category_name
                FROM news
                JOIN categories ON news.category_id = categories.id
                WHERE status = 'approved'
                ORDER BY news.views DESC
                LIMIT ?";
        
        $conn = Database::connect();
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $limit);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $newsItems = [];

        while ($row = $result->fetch_assoc()) {
            $newsItems[] = $row;
        }

        $stmt->close();
        return $newsItems;
    }

    public function getSideNews($limit = 4) {

        $sql = "SELECT news.*, categories.name AS category_name
                FROM news
                JOIN categories ON news.category_id = categories.id
                where status = 'approved'
                ORDER BY news.created_at DESC
                LIMIT ?";

        $conn = Database::connect();

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $limit);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getMostCommented($limit = 5) {

        $sql = "SELECT 
                    news.*, 
                    COUNT(comments.comment_id) AS comment_count,
                    MAX(comments.created_at) AS last_comment_date,
                    (SELECT content FROM comments 
                     WHERE news_id = news.id 
                     ORDER BY created_at DESC LIMIT 1) AS last_comment,
                    (SELECT author_name FROM comments 
                     WHERE comments.news_id = news.id 
                     ORDER BY created_at DESC LIMIT 1) AS last_comment_author
                  FROM news 
                  LEFT JOIN comments ON news.id = comments.news_id 
                  where news.status = 'approved'
                  GROUP BY news.id 
                  ORDER BY comment_count DESC 
                  LIMIT ?";
        $conn = Database::connect();

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $limit);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getLatestByCategory($categoryId, $limit = 5) {

        $sql = "SELECT news.*, categories.name AS category_name
                FROM news
                JOIN categories ON news.category_id = categories.id
                WHERE category_id = ? AND status = 'approved'
                ORDER BY news.created_at DESC
                LIMIT ?";

        $conn = Database::connect();

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $categoryId, $limit);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $newsItems = [];

        while ($row = $result->fetch_assoc()) {
            $newsItems[] = $row;
        }

        $stmt->close();
        return $newsItems;
    }

    public function incrementViews($id) {

        $conn = Database::connect();
        $stmt = $conn->prepare("UPDATE news SET views = views + 1 WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
    }

    public function create($data){
        $conn = Database::connect();
        $stmt = $conn->prepare("
            INSERT INTO news 
            (title, content, category_id, author_id, thumbnail_url, views, is_featured)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        
        $stmt->bind_param(
            'ssiissi', 
            $data['title'],
            $data['content'],
            $data['category_id'],
            $data['author_id'],
            $data['thumbnail_url'],
            $data['views'],
            $data['is_featured']
        );
        
        return $stmt->execute();
    }

    public function update($id, $title, $content, $author_id, $category_id, $thumbnail_url, $is_featured){
        $conn = Database::connect();
        $stmt = $conn->prepare("
            UPDATE news SET 
            title = ?,
            content = ?,
            author_id = ?,
            category_id = ?,
            thumbnail_url = ?,
            is_featured = ?
            WHERE id = ?
        ");
        
        $stmt->bind_param(
            'ssiissi',
            $title,
            $content,
            $author_id,
            $category_id,
            $thumbnail_url,
            $is_featured,
            $id
        );
        
        return $stmt->execute();
    }

    public function delete($id) {
        $conn = Database::connect();
        $stmt = $conn->prepare("DELETE FROM news WHERE id = ?");
        
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public function updateStatus($id, $status) {
        $conn = Database::connect();
        $stmt = $conn->prepare("UPDATE news SET status = ? WHERE id = ?");
        
        $stmt->bind_param('si', $status, $id);
        return $stmt->execute();
    }
}
?>
