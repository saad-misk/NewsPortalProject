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
    <title>Add News</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css">
</head>
<body class="container mt-5">

<?php
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
            'is_featured' => $is_featured,
        ]);

        if ($result) {
            echo "<div class='alert alert-success'>News article added successfully!</div>";
            echo "<a href='news_list.php' class='btn btn-primary mt-2'>Go to News List</a>";
            exit;
        } else {
            echo "<div class='alert alert-danger'>Error adding news article.</div>";
            echo "<a href='news_list.php' class='btn btn-primary mt-2'>Go to News List</a>";
        }
    }
?>

    <?php require_once '../nav.php' ?>

    <h2>Add News Article</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Title:</label>
            <input name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>content:</label>
            <textarea name="content" class="form-control" rows="5" required></textarea>
        </div>

        <div class="mb-3"> 
            <label>Thumbnail URL:</label>
            <input name="thumbnail_url" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Is Featured:</label>
            <select name="is_featured" class="form-select" required>
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Category:</label>
            <select name="category_id" class="form-select" required>
                <option value="">-- Select Category --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>"><?=$cat['name']?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Add News</button>
    </form>

    <a href="news_list.php" class="btn btn-secondary">Go Back to News List</a>

</body>
</html>
