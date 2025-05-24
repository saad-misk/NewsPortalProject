<?php
    session_start();

    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header("Location: ../../unauthorized.php");
        exit;
    }

    $name = $_SESSION['name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Category</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-DOXMLfHhQkvFFp+rWTZwVlPVqdIhpDVYT9csOnHSgWQWPX0v5MCGtjCJbY6ERspU" crossorigin="anonymous">

</head>
<body>

    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once '../../../models/Category.php';
            $categoryModel = new Category();
            $result = $categoryModel->create($_POST['name']);

            if( $result ){
                header("Location: categories_list.php");
            }else{
                echo "<div class='alert alert-danger'>Error creating category.</div>";
                echo "<a href='categories_list.php'>Go Back</a>";
                exit();
            }
        }
    ?>

    <?php require_once '../nav.php' ?>

    <div class="container mt-5">
        <h2 class="mb-4">Add Category</h2>
        <form method="POST" class="mb-3">
            <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="Category Name" required>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>

        <a href="../admin_dashboard.php" class="btn btn-secondary">Go Back to Categories List</a>
    </div>

</body>
</html>