<?php
session_start();
require_once '../../models/News.php';

if (!isset($_GET['id'])) {
    header("Location: ../error.php");
    exit;
}

$newsModel = new News();
$news = $newsModel->getById((int)$_GET['id']);

if (!$news) {
    echo "<div class='container mt-5'><div class='alert alert-danger'>News article not found.</div></div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $news['title'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="mb-4">
        <a href="javascript:history.back()" class="btn btn-secondary">← Back</a>
    </div>

    <div class="card shadow">
        <?php if (!empty($news['thumbnail_url'])): ?>
            <img src="<?= $news['thumbnail_url'] ?>" class="card-img-top" alt="Thumbnail">
        <?php endif; ?>

        <div class="card-body">
            <h1 class="card-title"><?= $news['title'] ?></h1>
            <p class="text-muted">
                Category: <strong><?= $news['category_name'] ?></strong> | 
                Views: <?= $news['views'] ?> | 
                Published on: <?= date("F j, Y", strtotime($news['created_at'])) ?>
            </p>
            <hr>
            <div class="card-text">
                <?= nl2br($news['content']) ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>