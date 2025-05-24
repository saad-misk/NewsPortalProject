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
    <title>Add Editor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-DOXMLfHhQkvFFp+rWTZwVlPVqdIhpDVYT9csOnHSgWQWPX0v5MCGtjCJbY6ERspU" crossorigin="anonymous">

</head>
<body>

    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once '../../../models/User.php';
            $userModel = new User();
            $result = $userModel->create($_POST['name'], $_POST['email'], $_POST['password'], 'editor', ' ');

            if( $result ){
                header("Location: editors_list.php");
            }else{
                echo "<div class='alert alert-danger'>Error creating editor.</div>";
                echo "<a href='editors_list.php'>Go Back</a>";
                exit();
            }
        }
    ?>

    <?php require_once '../nav.php' ?>

    <h2>Add editor</h2>
    <form method="POST">
        <input name="name" placeholder="Name" required>
        <input name="email" placeholder="Email" required type="email">
        <input name="password" placeholder="Password" required type="password">
        <button type="submit">Add</button>
    </form>

    <a href="editors_list.php" class="btn btn-secondary">Go Back to editors List</a>

</body>
</html>