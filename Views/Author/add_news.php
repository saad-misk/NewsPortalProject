<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'author') {
    header("Location: ../../unauthorized.php");
    exit;
}

require_once '../../models/Category.php';
require_once '../../models/News.php';

$categoryModel = new Category();
$categories = $categoryModel->getAll();

$success = false;
$error = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $categoryId = $_POST['category_id'];
    $thumbnail_url = $_POST['thumbnail_url'];
    $is_featured = $_POST['is_featured'];

    $newsModel = new News();
    $result = $newsModel->create([
        'title' => $title,
        'content' => $content,
        'category_id' => $categoryId,
        'author_id' => $_SESSION['user_id'],
        'thumbnail_url' => $thumbnail_url,
        'views' => 0,
        'is_featured' => $is_featured
    ]);

    $success = $result;
    $error = !$result;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add News</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">📝 Add News Article</h2>

    <?php if ($success): ?>
        <div class="alert alert-success">News article added successfully!</div>
        <a href="author_dashboard.php" class="btn btn-primary mt-2">Go to Author Dashboard</a>
    <?php elseif ($error): ?>
        <div class="alert alert-danger">❌ Error adding news article. Please try again.</div>
    <?php endif; ?>

    <form method="POST" class="bg-white p-4 shadow rounded">
        <div class="mb-3">
            <label class="form-label">Title:</label>
            <input name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Content:</label>
            <textarea name="content" class="form-control" rows="6" required></textarea>
        </div>

        <div class="mb-3"> 
            <label class="form-label">Thumbnail URL:</label>
            <input name="thumbnail_url" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Is Featured:</label>
            <select name="is_featured" class="form-select" required>
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Category:</label>
            <select name="category_id" class="form-select" required>
                <option value="">-- Select Category --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">✅ Add News</button>
            <a href="news_list.php" class="btn btn-secondary">⬅ Go Back</a>
        </div>
    </form>
</div>
</body>
</html>
