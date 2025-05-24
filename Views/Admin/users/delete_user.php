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
    <title>Editors List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-DOXMLfHhQkvFFp+rWTZwVlPVqdIhpDVYT9csOnHSgWQWPX0v5MCGtjCJbY6ERspU" crossorigin="anonymous">

</head>
<body>
    <?php
        require_once '../../../models/User.php';
        $id = $_GET['id'];
        $type = $_GET['type'];

        $userModel = new User();
        $userModel->delete($id);
        header("Location: {$type}s_list.php");
    ?>
</body>
</html>