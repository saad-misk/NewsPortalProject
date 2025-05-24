<?php
    session_start();

    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header("Location: ../unauthorized.php");
        exit;
    }

    $name = $_SESSION['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard | News Portal</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        .card:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            transform: scale(1.02);
            transition: 0.3s;
        }
    </style>
</head>
<body>

    <?php require_once 'nav.php' ?>

    <div class="container mt-5">
    <h2 class="mb-4">Admin Dashboard</h2>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

        <div class="col">
        <div class="card h-100">
            <div class="card-body">
            <h5 class="card-title"><i class="bi bi-person-badge-fill me-2"></i>Manage Editors</h5>
            <p class="card-text">Add, update, or remove editor accounts.</p>
            <a href="./users/editors_list.php" class="btn btn-primary">Go</a>
            </div>
        </div>
        </div>

        <div class="col">
        <div class="card h-100">
            <div class="card-body">
            <h5 class="card-title"><i class="bi bi-pencil-fill me-2"></i>Manage Authors</h5>
            <p class="card-text">Manage author roles and permissions.</p>
            <a href="./users/authors_list.php" class="btn btn-primary">Go</a>
            </div>
        </div>
        </div>

        <div class="col">
        <div class="card h-100">
            <div class="card-body">
            <h5 class="card-title"><i class="bi bi-newspaper me-2"></i>Manage News</h5>
            <p class="card-text">Review and edit all news articles.</p>
            <a href="./news/news_list.php" class="btn btn-primary">Go</a>
            </div>
        </div>
        </div>

        <div class="col">
        <div class="card h-100">
            <div class="card-body">
            <h5 class="card-title"><i class="bi bi-tags-fill me-2"></i>Manage Categories</h5>
            <p class="card-text">Create and organize news categories.</p>
            <a href="./categories/categories_list.php" class="btn btn-primary">Go</a>
            </div>
        </div>
        </div>

        <!-- <div class="col">
        <div class="card h-100">
            <div class="card-body">
            <h5 class="card-title"><i class="bi bi-hourglass-split me-2"></i>Pending News Review</h5>
            <p class="card-text">Approve or reject submitted news articles.</p>
            <a href="pending_news.php" class="btn btn-primary">Go</a>
            </div>
        </div>
        </div> -->

        <div class="col">
        <div class="card h-100 border-danger">
            <div class="card-body">
            <h5 class="card-title text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</h5>
            <p class="card-text">Sign out of the admin panel.</p>
            <a href="../logout.php" class="btn btn-outline-danger">Logout</a>
            </div>
        </div>
        </div>

    </div>
    </div>

</body>
</html>