<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'editor') {
    header("Location: ../unauthorized.php");
    exit;
}

$name = $_SESSION['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editor Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        .card-text {
            white-space: pre-wrap;
            overflow-wrap: break-word;
        }
    </style>
</head>
<body class="bg-light">
    <?php
        require_once '../../models/User.php';
        require_once '../../models/News.php';

        $userModel = new User();
        $newsModel = new News();

        $user = $userModel->getById($_SESSION['user_id']);
        $news = $newsModel->getNotApproved();
    ?>

    <div class="container mt-5">
        <h2 class="mb-4">Welcome, Editor <?= $name ?>!</h2>
        
        <div class="d-flex justify-content-end mb-4">
            <a href="../logout.php" class="btn btn-outline-danger">🚪 Logout</a>
        </div>

        <?php if (count($news) === 0): ?>
            <div class="alert alert-info">There are no pending articles for review.</div>
        <?php endif; ?>

        <?php foreach ($news as $newsItem): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title"><?= $newsItem["title"] ?></h5>
                    <p class="card-text"><?= $newsItem["content"] ?></p>
                    <p class="text-muted">Status: <?= $newsItem["status"] ?></p>
                    <div class="d-flex gap-2">
                        <a href="approve_news.php?id=<?= $newsItem["id"] ?>" class="btn btn-sm btn-success">✅ Approve</a>
                        <a href="reject_news.php?id=<?= $newsItem["id"] ?>" class="btn btn-sm btn-danger">❌ Reject</a>
                    </div>
                    <a href="view_news.php?id=<?= $newsItem["id"] ?>" class="btn btn-sm btn-info mt-3">View</a>

                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>