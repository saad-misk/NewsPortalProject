<?php
    require_once '../../../models/News.php';

    $id = $_GET['id'];

    $newsModel = new News();
    $newsModel->delete($id);

    header('Location: news_list.php');
    exit();
?>
