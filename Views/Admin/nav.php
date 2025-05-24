
<?php $name = $_SESSION['name']; ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="http://localhost/NewsPortal/Views/Admin/admin_dashboard.php">Admin Panel</a>
            <div class="d-flex align-items-center">
            <span class="navbar-text text-white me-3">
                Welcome, <?= $name ?>
            </span>
            <a href="http://localhost/NewsPortal/Views/logout.php" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>

