<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'editor') {
    header("Location: ../unauthorized.php");
    exit;
}

require_once '../../models/News.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid news ID.");
}

$newsModel = new News();
$news = $newsModel->getById($_GET['id']);

if (!$news) {
    die("News article not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View News Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        .thumbnail-img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2><?= $news['title'] ?></h2>
        <p class="text-muted">Category: <?= $news['category_name'] ?> | Status: <?= $news['status'] ?></p>
        <p class="text-muted">Created at: <?= $news['created_at'] ?></p>
        <p class="text-muted">Featured: <?= $news['is_featured'] ? 'Yes' : 'No' ?></p>
        
        <?php if ($news['thumbnail_url']): ?>
            <div class="mb-4">
                <img src="<?= $news['thumbnail_url'] ?>" alt="Thumbnail" class="thumbnail-img">
            </div>
        <?php endif; ?>

        <div class="mb-5">
            <h5>Content:</h5>
            <div class="border p-3 bg-white shadow-sm" style="white-space: pre-wrap; overflow-wrap: break-word;">
                <?= $news['content'] ?>
            </div>
        </div>

        <a href="editor_dashboard.php" class="btn btn-secondary">⬅ Back to Dashboard</a>
    </div>
</body>
</html>