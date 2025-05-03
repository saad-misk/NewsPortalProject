<?php
    session_start();

    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header("Location: ../../unauthorized.php");
        exit;
    }

    $name = htmlspecialchars($_SESSION['name']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Author</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-DOXMLfHhQkvFFp+rWTZwVlPVqdIhpDVYT9csOnHSgWQWPX0v5MCGtjCJbY6ERspU" crossorigin="anonymous">

</head>
<body>
    <?php
        require_once '../../../models/Category.php';
        $categoryModel = new Category();
        $category = $categoryModel->getById($_GET['id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category["name"] = $_POST['name'];
            $userModel->update($_GET["id"], $category["name"]);
            header("Location: categories_list.php");
        }
    ?>

    <h2>Edit Category</h2>
    <form method="POST">
        <input name="name" value="<?= $category["name"] ?>" required>
        <button type="submit">Update</button>
    </form>

</body>
</html>