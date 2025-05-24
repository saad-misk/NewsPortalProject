<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'author') {
    header("Location: ../unauthorized.php");
    exit;
}

require_once '../../models/Category.php';
require_once '../../models/News.php';

$newsModel = new News();
$catModel = new Category();

$news_article = $newsModel->getById($_GET["id"]);
$categories = $catModel->getAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $categoryId = intval($_POST['category_id']);
    $thumbnail_url = $_POST['thumbnail_url'];
    $is_featured = intval($_POST['is_featured']);

    $result = $newsModel->update(
        $news_article['id'],
        $title,
        $content,
        $_SESSION['user_id'],
        $categoryId,
        $thumbnail_url,
        $is_featured
    );

    if ($result) {
        echo "<div class='alert alert-success'>News article updated successfully!</div>";
        echo "<a href='author_dashboard.php' class='btn btn-primary mt-2'>Go to Author Dashboard</a>";
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error editing news article.</div>";
        echo "<a href='author_dashboard.php' class='btn btn-primary mt-2'>Go to Author Dashboard</a>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit News</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">✏️ Edit News Article</h2>

    <form method="POST" class="bg-white p-4 shadow rounded">
        <div class="mb-3">
            <label class="form-label">Title:</label>
            <input name="title" class="form-control" value="<?= $news_article["title"] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Content:</label>
            <textarea name="content" class="form-control" rows="6" required><?= $news_article["content"] ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Thumbnail URL:</label>
            <input name="thumbnail_url" class="form-control" value="<?= $news_article["thumbnail_url"] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Is Featured:</label>
            <select name="is_featured" class="form-select" required>
                <option value="0" <?= $news_article["is_featured"] == 0 ? 'selected' : '' ?>>No</option>
                <option value="1" <?= $news_article["is_featured"] == 1 ? 'selected' : '' ?>>Yes</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Category:</label>
            <select name="category_id" class="form-select" required>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $news_article['category_id'] ? 'selected' : '' ?>>
                        <?= $cat['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">💾 Save Changes</button>
            <a href="author_dashboard.php" class="btn btn-secondary">⬅ Go Back</a>
        </div>
    </form>
</div>
</body>
</html>