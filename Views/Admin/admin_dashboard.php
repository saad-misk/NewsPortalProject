<?php
    session_start();

    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header("Location: ../unauthorized.php");
        exit;
    }

    $name = htmlspecialchars($_SESSION['name']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-DOXMLfHhQkvFFp+rWTZwVlPVqdIhpDVYT9csOnHSgWQWPX0v5MCGtjCJbY6ERspU" crossorigin="anonymous">

</head>
<body>
    <div class="container mt-4">
        <h2>Welcome, Admin <?= $name ?>!</h2>
        <hr>

        <div class="list-group">
            <a href="./users/editors_list.php" class="list-group-item list-group-item-action">Manage Editors</a>
            <a href="./users/authors_list.php" class="list-group-item list-group-item-action">Manage Authors</a>
            <a href="./news/news_list.php" class="list-group-item list-group-item-action">Manage News</a>
            <a href="./categories/categories_list.php" class="list-group-item list-group-item-action">Manage Categories</a>
            <a href="pending_news.php" class="list-group-item list-group-item-action">Pending News Review</a>
            <a href="../logout.php" class="list-group-item list-group-item-action text-danger">Logout</a>
        </div>
    </div>
</body>
</html>
