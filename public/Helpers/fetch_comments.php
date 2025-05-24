<?php
require_once 'C:\xampp\htdocs\NewsPortal\config\databaseConfig.php';

require_once 'C:\xampp\htdocs\NewsPortal\models\Comment.php';

$newsId = $_GET['id'];

$commentModel = new Comment();
$comments = $commentModel->getLatestComments($newsId);

echo '<span id="comments-count">' . count($comments) . '</span>';

if (!empty($comments)) {
    foreach ($comments as $comment) {
        echo '<div class="comment-card mb-4 p-3 border rounded">';
        echo '<div class="d-flex justify-content-between">';
        echo '<h6 class="fw-bold">' . htmlspecialchars($comment['author_name']) . '</h6>';
        echo '<span class="text-muted small">' . date('d M Y H:i', strtotime($comment['created_at'])) . '</span>';
        echo '</div>';
        echo '<p class="mt-2">' . htmlspecialchars($comment['content']) . '</p>';
        echo '</div>';
    }
} else {
    echo '<p class="text-muted">لا توجد تعليقات بعد. كن أول من يعلق!</p>';
}
?>
