<?php
    session_start();

    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header("Location: ../../unauthorized.php");
        exit;
    }

    require_once '../../../models/Category.php';
    require_once '../../../models/News.php';

    $categoryModel = new Category();
    $categories = $categoryModel->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit News</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css">
</head>
<body class="container mt-5">

    <?php

        $newsModel = new News();
        $catModel = new Category();
        $news_article = $newsModel->getById($_GET["id"]);

        $categories = $catModel->getAll();
        $news_article_cat = $catModel->getById($news_article['category_id']);


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $categoryId = $_POST['category_id'];
            $thumbnail_url = $_POST['thumbnail_url'];
            $is_featured = $_POST['is_featured'];
            
            $result = $newsModel->update($news_article['id'], $title, $content, $_SESSION['user_id'], $categoryId, $thumbnail_url, $is_featured);

            if ($result) {
                echo "<div class='alert alert-success'>News article altered successfully!</div>";
                echo "<a href='news_list.php' class='btn btn-secondary mt-2'>Go to News List</a>";
                exit;
            } else {
                echo "<div class='alert alert-danger'>Error editing news article.</div>";
                echo "<a href='news_list.php' class='btn btn-secondary mt-2'>Go to News List</a>";
            }
        }
    ?>

    <?php require_once '../nav.php' ?>

    <h2>Edit News Article</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Title:</label>
            <input name="title" class="form-control" value="<?= $news_article["title"] ?>" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content:</label>
            <textarea name="content" class="form-control" rows="5" required><?=$news_article["content"]?></textarea>
        </div>

        <div class="mb-3"> 
            <label>Thumbnail URL:</label>
            <input name="thumbnail_url" class="form-control" value="<?= $news_article["thumbnail_url"] ?>" required>
        </div>

        <div class="mb-3">
            <label>Is Featured:</label>
            <select name="is_featured" class="form-select" value="<?= $news_article["is_featured"] ?>" required>
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Category:</label>
            <select name="category_id" class="form-select" required>
                <option value="<?= $news_article_cat["id"] ?>"><?=$news_article_cat["name"]?></option>
                <?php foreach ($categories as $cat): ?>
                    <?php if($news_article_cat["name"] === $cat['name']){ continue; }?>
                    <option value="<?= $cat['id'] ?>"><?=$cat['name']?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Edit News</button>
    </form>
    <a href="news_list.php" class="btn btn-secondary">Go Back to News List</a>

</body>
</html>