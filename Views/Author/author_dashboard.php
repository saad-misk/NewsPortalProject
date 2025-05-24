<?php
session_start();+

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'author') {
    header("Location: ../unauthorized.php");
    exit;
}

require_once '../../models/User.php';
require_once '../../models/News.php';

$userModel = new User();
$newsModel = new News();

$user = $userModel->getById($_SESSION['user_id']);
$news = $newsModel->getByAuthor($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Author Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Author Dashboard</span>
        <a href="../logout.php" class="btn btn-outline-danger">Logout</a>
    </div>
</nav>

<div class="container mt-4">
    <h2 class="mb-4">Welcome, <?= $user["name"] ?>!</h2>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Your News (<?= count($news) ?>)</h4>
        <a href="add_news.php" class="btn btn-success"><i class="bi bi-plus-circle"></i> Add New Article</a>
    </div>

    <?php if (count($news) > 0): ?>
        <?php foreach ($news as $item): ?>
            <a href="view_news.php?id=<?= $item["id"] ?>" class="text-decoration-none">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?= $item["title"] ?></h5>
                        <p class="card-text text-muted"><?= substr($item["content"], 0, 200) ?>...</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-secondary me-2"><?= $item["status"] ?></span>
                                <small class="text-muted">Created: <?= date('Y-m-d', strtotime($item["created_at"])) ?></small>
                            </div>
                            <div>
                                <a href="edit_news.php?id=<?= $item["id"] ?>" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil-fill"></i> Edit</a>
                                <a href="delete_news.php?id=<?= $item["id"] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this news item?')"><i class="bi bi-trash-fill"></i> Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-info">You haven't added any news yet.</div>
    <?php endif; ?>
</div>

</body>
</html>
