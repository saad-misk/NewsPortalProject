<?php
require_once '../models/News.php';
require_once '../models/Comment.php';

if (!isset($_GET['id'])) {
    header("Location: 404.php");
    exit();
}

$newsId = $_GET['id'];
$newsModel = new News();
$article = $newsModel->getById($newsId);

if(!$article) {
    header("Location: 404.php");
    exit();
}

// Increment views count
$newsModel->incrementViews($newsId);

$relatedNews = $newsModel->getLatestByCategory($article['category_id'], 3);
$sameCategoryNews = $newsModel->getLatestByCategory($article['category_id'], 5);
$comments = (new Comment())->getCommentsByNewsId($newsId);

// Format date
$createdAt = new DateTime($article['created_at']);
$formattedDate = $createdAt->format('d F Y');
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>details-page</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-DOXMLfHhQkvFFp+rWTZwVlPVqdIhpDVYT9csOnHSgWQWPX0v5MCGtjCJbY6ERspU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/details_page.css">

    <script>
        function loadComments() {
            fetch('./Helpers/fetch_comments.php?id=<?= $newsId ?>')
                .then(response => response.text())
                .then(html => {
                    const temp = document.createElement('div');
                    temp.innerHTML = html;

                    const count = temp.querySelector('#comments-count');
                    if (count) {
                        document.getElementById('comments-count').innerText = count.innerText;
                        count.remove(); 
                    }

                    document.getElementById('comments-section').innerHTML = temp.innerHTML;
                })
                .catch(error => {
                    console.error('Error loading comments:', error);
                });
        }

        setInterval(loadComments, 5000);

        loadComments();
        </script>


</head>
<body>

    <?php include './partials/nav.php'?>

    <div class="container-fluid mt-5 ps-3 pe-5 ">
        <div class="row">
            <div class="col-8">
                <div class="category text-muted mb-2">
                    <?= htmlspecialchars($article['category_name'])?>
                </div>
            
                <h3 class="fw-bold"><?= htmlspecialchars($article['title'])?></h3>
            
                <div class="mb-3">
                    <img src="images/calendar_icon.png" class="category date" alt="Calendar icon">
                    <span class="text-muted me-2"><?= $formattedDate ?></span>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <span class="fw-bold">شارك القصة:</span>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled d-flex align-items-center justify-content-end gap-2">
                            <li><a href="https://www.facebook.com" target="_blank" class="d-inline-block"><img src="images/facebook.png" alt="Share on Facebook" width="24"></a></li>
                            <li><a href="https://twitter.com" target="_blank" class="d-inline-block"><img src="images/twitter.png" alt="Share on Twitter" width="24"></a></li>
                            <li><a href="mailto" class="d-inline-block"><img src="images/email.png" alt="Share via Email" width="24"></a></li>
                            <li><a href="#" class="d-inline-block"><img src="images/sharing.png" alt="Share on Telegram" width="24"></a></li>
                        </ul>
                    </div>
                </div>

                <figure class="mt-2">
                    <img src="<?= htmlspecialchars($article['thumbnail_url'])?>" class="img-fluid" width="100%" alt="<?= htmlspecialchars($article['title'])?>">
                    <div class="image-description pe-2 pb-2"><?= htmlspecialchars($article['title'])?></div>  
                </figure>

                <div class="article-content"> 
                    <?=  htmlspecialchars($article['content']) ?>

                    <div class="container d-flex justify-content-between border-bottom pb-2 px-0 mb-5">
                        <div class="fw-bold fs-4">
                            <span class="border-bottom border-4 border-primary text-muted">إقرأ أيضاً</span>    
                        </div>
                    </div>
                    <?php foreach($relatedNews as $related): ?>
                    <a href="details_page.php?id=<?=  htmlspecialchars($related['id']) ?>" class="link-dark text-decoration-none">
                        <p class="fs-5"><?= htmlspecialchars($related['title'])?></p>
                    </a>
                    <hr>
                    <?php endforeach; ?>
                </div>

                <div class="comments-section mt-5">
                    <h4 class="mb-4">التعليقات (<span id="comments-count"><?= count($comments) ?></span>)</h4>
                    <div id="comments-section">
                        <?php if(!empty($comments)): ?>
                            <?php foreach($comments as $comment): ?>
                            <div class="comment-card mb-4 p-3 border rounded">
                                <div class="d-flex justify-content-between">
                                    <h6 class="fw-bold"><?=  htmlspecialchars($comment['author_name']) ?></h6>
                                    <span class="text-muted small"><?= date('d M Y H:i', strtotime($comment['created_at'])) ?></span>
                                </div>
                                <p class="mt-2"><?= $comment['content'] ?></p>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted">لا توجد تعليقات بعد. كن أول من يعلق!</p>
                        <?php endif; ?>
                    </div>

                    <form action="./Helpers/post_comment.php" method="POST" class="mt-5">
                        <input type="hidden" name="news_id" value="<?= $newsId ?>">
                        <div class="mb-3">
                            <textarea name="comment" class="form-control" rows="4" placeholder="اكتب تعليقك..." required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="اسمك" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control" placeholder="البريد الإلكتروني (اختياري)">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">نشر التعليق</button>
                    </form>
                </div>
            </div>

            <div class="col-4 mt-5">
                <div class="d-flex border-bottom pb-1 px-0 mt-5">
                    <div class="fw-bold fs-4 mb-1 mt-5 pt-4">
                        <span class="border-bottom border-4 border-primary text-muted">المزيد من <?=  htmlspecialchars($article['category_name']) ?></span>    
                    </div>
                </div>

                <ul class="list-unstyled mt-3 px-0">
                    <?php foreach($sameCategoryNews as $news): ?>
                    <li class="news-item d-flex align-items-start gap-2 mb-3">
                        <span class="bullet text-primary">◆</span>
                        <a href="details_page.php?id=<?=  htmlspecialchars($news['id']) ?>" class="link-dark fw-bold text-decoration-none"><?=  htmlspecialchars($news['title']) ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>

                <div class="container d-flex border-bottom mb-5 mt-3 px-0 pb-2">
                    <div class="fw-bold fs-4 mt-5 pt-5">
                        <span class="border-bottom border-4 border-primary text-muted">موضوعات ذات صلة</span>    
                    </div>
                </div>

                <ul class="list-unstyled mt-3 px-0">
                    <?php foreach($relatedNews as $related): ?>
                    <li class="news-item d-flex align-items-start gap-2 mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="<?=  htmlspecialchars($related['thumbnail_url']) ?>" class="img-fluid" alt="<?=  htmlspecialchars($related['title']) ?>">
                            </div>
                            <div class="col-md-8">
                                <div class="category my-2"><?= htmlspecialchars($related['category_name']) ?></div>
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <a href="details_page.php?id=<?=  htmlspecialchars($related['id']) ?>" class="text-decoration-none text-dark">
                                            <?=  htmlspecialchars($related['title']) ?>
                                        </a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <?php include './partials/footer.php' ?>
    
</body>
</html>