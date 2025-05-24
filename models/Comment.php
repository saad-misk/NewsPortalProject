<?php

require_once 'C:\xampp\htdocs\NewsPortal\config\databaseConfig.php';

class Comment {

    public function addComment($data) {
        $conn = Database::connect();

        $query = "INSERT INTO comments 
                 (news_id, author_name, author_email, content, status, created_at)
                 VALUES (?, ?, ?, ?, ?, NOW())";

        $stmt = $conn->prepare($query);
        $stmt->bind_param(
            'issss',
            $data['news_id'],
            $data['author_name'],
            $data['author_email'],
            $data['content'],
            $data['status']
        );

        $stmt->execute();
    }

    public function getCommentsByNewsId($newsId) {
        
        $conn = Database::connect();
        
        $query = "SELECT * FROM comments 
                  WHERE news_id = ? 
                  ORDER BY created_at DESC";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $newsId);
        $stmt->execute();
        
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getLatestComments($newsId, $limit = 5) {

        $sql = "SELECT *
                FROM comments
                where news_id = ?
                ORDER BY    created_at DESC
                LIMIT ?";

        $conn = Database::connect();

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $newsId, $limit);
        $stmt->execute();

        $result = $stmt->get_result();
        $comments = [];

        while($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }

        return $comments;
    }
}

?>