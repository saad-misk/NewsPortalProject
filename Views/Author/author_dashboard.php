<?php
    session_start();

    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'author') {
        header("Location: ../unauthorized.php");
        exit;
    }

    $name = htmlspecialchars($_SESSION['name']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Author Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-DOXMLfHhQkvFFp+rWTZwVlPVqdIhpDVYT9csOnHSgWQWPX0v5MCGtjCJbY6ERspU" crossorigin="anonymous">

</head>
<body>
    <?php
    
        require_once '../../models/User.php';
        require_once '../../models/News.php';

        $userModel = new User();
        $newsModel = new News();
        $user = $userModel->getById($_SESSION['user_id']);

        $news = $newsModel->getByAuthor($_SESSION['user_id']);

    ?>
    <div class="container mt-4">
        <h2>Welcome, Author <?= $user["name"] ?>!</h2>
        <hr>
        <div class="list-group mb-4">
            <a href="add_news.php" class="btn btn-primary mb-3">+ Add New</a> 
            <a href="../logout.php" class="list-group-item list-group-item-action text-danger">Logout</a>
        </div>
        <?php foreach($news as $newsItem){ ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?= $newsItem["title"] ?></h5>
                    <p class="card-text"><?= $newsItem["content"] ?></p>
                    <a href="edit_news.php?id=<?= $newsItem["id"] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="delete_news.php?id=<?= $newsItem["id"] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>                    
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>