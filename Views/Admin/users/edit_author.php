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
    <title>Edit Author</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-DOXMLfHhQkvFFp+rWTZwVlPVqdIhpDVYT9csOnHSgWQWPX0v5MCGtjCJbY6ERspU" crossorigin="anonymous">

</head>
<body>
    <?php
        require_once '../../../models/User.php';
        $userModel = new User();
        $user = $userModel->getById($_GET['id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user["name"] = $_POST['name'];
            $user["email"] = $_POST['email'];
            if (!empty($_POST['password'])) {
                $user["password"] = $_POST['password'];
            }
            $userModel->update($_GET["id"], $user["name"], $user["email"], $user["password"], $user["bio"]);
            header("Location: authors_list.php");
        }
    ?>

    <?php require_once '../nav.php' ?>

    <h2>Edit Author</h2>
    <form method="POST">
        <input name="name" value="<?= $user["name"] ?>" required>
        <input name="email" value="<?= $user["email"] ?>" required type="email">
        <input name="password" placeholder="New Password (optional)" type="password">
        <button type="submit">Update</button>
    </form>

    <a href="authors_list.php" class="btn btn-secondary">Go Back to authors List</a>

</body>
</html>