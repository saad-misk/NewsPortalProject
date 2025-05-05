<?php
    session_start();

    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'editor') {
        header("Location: ../unauthorized.php");
        exit;
    }

    $name = htmlspecialchars($_SESSION['name']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editor Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-DOXMLfHhQkvFFp+rWTZwVlPVqdIhpDVYT9csOnHSgWQWPX0v5MCGtjCJbY6ERspU" crossorigin="anonymous">

</head>
<body>
    <?php
    
        require_once '../../models/User.php';
        require_once '../../models/News.php';

        $userModel = new User();
        $newsModel = new News();
        $user = $userModel->getById($_SESSION['user_id']);

        $news = $newsModel->getNotApproved();

    ?>
    <div class="container mt-4">
        <h2>Welcome, Editor <?= $name ?>!</h2>
        <hr>
        <div class="list-group mb-4">
            <a href="../logout.php" class="list-group-item list-group-item-action text-danger">Logout</a>
        </div>
        <?php foreach($news as $newsItem){ ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?= $newsItem["title"] ?></h5>
                    <p class="card-text"><?= $newsItem["content"] ?></p>
                    <h6 class="card-subtitle mb-2 text-muted"><?= $newsItem["status"] ?></h6>
                    <a href="approve_news.php?id=<?= $newsItem["id"] ?>" class="btn btn-sm btn-success">Approve</a>
                    <a href="reject_news.php?id=<?= $newsItem["id"] ?>" class="btn btn-sm btn-danger">Reject</a>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>