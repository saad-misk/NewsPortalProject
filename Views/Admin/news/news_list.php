<?php

    session_start();

    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header("Location: ../../unauthorized.php");
        exit;
    }
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage News</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-DOXMLfHhQkvFFp+rWTZwVlPVqdIhpDVYT9csOnHSgWQWPX0v5MCGtjCJbY6ERspU" crossorigin="anonymous">

</head>
<body>
    <?php
        require_once '../../../models/News.php';
        $newsModel = new News();
        $news = $newsModel->getAll();
    ?>
    <div class="container mt-5">
        <h2 class="mb-3">News List (<?= count($news) ?>)</h2>
        <a href="add_news.php" class="btn btn-primary mb-3">+ Add New</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Created At</th>
                    <th>Views</th>
                    <th>is_featured</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($news as $news_item): ?>
                <tr>
                    <td><?= htmlspecialchars($news_item['title']) ?></td>
                    <td><?= htmlspecialchars($news_item['author_name']) ?></td>
                    <td><?= htmlspecialchars($news_item['category_name']) ?></td>
                    <td><?= htmlspecialchars($news_item['created_at']) ?></td>
                    <td><?= htmlspecialchars($news_item['views']) ?></td>
                    <td><?= htmlspecialchars($news_item['is_featured']) ?></td>
                    <td><?= htmlspecialchars($news_item['status']) ?></td>
                    <td class=" d-flex justify-content-center align-items-center gap-2">
                        <a href="edit_news.php?id=<?= $news_item['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="delete_news.php?id=<?= $news_item['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>