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
        if( !isset($_GET["id"]) ){
            header("Location: ../unauthorized.php");
            exit;
        }
        require_once '../../models/News.php';

        $newsModel = new News();

        $news = $newsModel->getById($_GET["id"]);

        $newsModel->updateStatus($_GET["id"], "rejected");

        header("Location: editor_dashboard.php");
        exit;
    ?>
</body>
</html>