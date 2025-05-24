<?php
session_start();
require_once '../../models/Comment.php';
require_once '../../models/News.php';

// Validate required fields
if (!isset($_POST['news_id']) || empty($_POST['comment']) || empty($_POST['name'])) {
    $_SESSION['comment_error'] = 'الرجاء ملء جميع الحقول المطلوبة';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

$newsId = $_POST['news_id'];
$name = htmlspecialchars($_POST['name']);
$email = trim($_POST['email'] ?? '');
$comment = htmlspecialchars($_POST['comment']);

// Validate news exists
$newsModel = new News();
if (!$newsModel->getById($newsId)) {
    $_SESSION['comment_error'] = 'الخبر غير موجود';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

// Save comment
$commentModel = new Comment();
$commentModel->addComment([
    'news_id' => $newsId,
    'author_name' => $name,
    'author_email' => $email,
    'content' => $comment,
    'status' => 'pending', // For moderation
    'ip_address' => $_SERVER['REMOTE_ADDR']
]);

$_SESSION['comment_success'] = 'تم إرسال تعليقك بنجاح، سيظهر بعد المراجعة';

header("Location: ../details_page.php?id=$newsId");
exit();
?>