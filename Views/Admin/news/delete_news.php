<?php

    session_start();

    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header("Location: ../../unauthorized.php");
        exit;
    }
    
    require_once '../../../models/News.php';

    $id = $_GET['id'];

    $newsModel = new News();
    $newsModel->delete($id);

    header('Location: news_list.php');
    exit();
?>
