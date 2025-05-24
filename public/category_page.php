<?php
require_once '../models/News.php';
require_once '../models/Category.php';

if (!isset($_GET['id'])) {
    header("Location: 404.php");
    exit();
}

$categoryId = $_GET['id'];
$newsModel = new News();
$categoryModel = new Category();

$category = $categoryModel->getById($categoryId);
if (!$category) {
    header("Location: 404.php");
    exit();
}

$categoryNews = $newsModel->getLatestByCategory($categoryId, 6);

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$category['name']?> - أخبار</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/category_page.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

    <?php include './partials/nav.php'?>

    <div class="container mt-5">

        <div class="container d-flex justify-content-between border-bottom px-0 mb-5">
            <div class="fw-bold fs-4 pb-2">
                <span class="border-bottom border-4 border-primary"><?= htmlspecialchars($category['name'])?></span>    
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-8">
                <div class="square-card main-news mb-4">
                    <img src="<?= htmlspecialchars($categoryNews[0]['thumbnail_url']);?>" class="card-img-top img-fluid mb-2" alt="category_new_img">
                    <div class="category my-2"><?= htmlspecialchars($categoryNews[0]['category_name']);?></div>
                    <div class="card-body">
                        <h5 class="card-title mb-2"><?= htmlspecialchars($categoryNews[0]['title']);?></h5>
                        <p class="description"><?= htmlspecialchars($categoryNews[0]['content']);?></p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="square-card sub-news mb-3">
                    <img src="<?= htmlspecialchars($categoryNews[1]['thumbnail_url']);?>" class="card-img-top" alt="category_new_img">
                    <div class="card-body">
                        <div class="category my-2"><?= htmlspecialchars($categoryNews[1]['category_name']);?></div>
                        <h6 class="card-title"><?= htmlspecialchars($categoryNews[1]['title']);?></h6>
                        <p class="text-muted"><?= htmlspecialchars($categoryNews[1]['content']);?>...</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?= htmlspecialchars($categoryNews[2]['thumbnail_url']);?>" class="img-fluid" alt="category_new_img">
                    </div>
                    <div class="col-md-8">
                        <div class="category my-2"><?= htmlspecialchars($categoryNews[2]['category_name']);?></div>
                        <div class="card-body">
                            <h6 class="card-title"><?= htmlspecialchars($categoryNews[2]['title']);?></h6>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <img src="<?= htmlspecialchars($categoryNews[3]['thumbnail_url']);?>" class="img-fluid" alt="category_new_img">
                    </div>
                    <div class="col-md-8">
                        <div class="category my-2"><?= htmlspecialchars($categoryNews[3]['category_name']);?></div>
                        <div class="card-body">
                            <h6 class="card-title"><?= htmlspecialchars($categoryNews[3]['title']);?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>  

        <div class="row ">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?= htmlspecialchars($categoryNews[4]['thumbnail_url']);?>" class="img-fluid" alt="category_new_img">
                    </div>
                    <div class="col-md-8">
                        <div class="category my-2"><?= htmlspecialchars($categoryNews[4]['category_name']);?></div>
                        <div class="card-body">
                            <h5 class="card-title mb-3"><?= htmlspecialchars($categoryNews[4]['title']);?></h5>
                            <p class="description"><?= htmlspecialchars($categoryNews[4]['content']);?></p>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <img src="<?= htmlspecialchars($categoryNews[5]['thumbnail_url']);?>" class="img-fluid" alt="category_new_img">
                    </div>
                    <div class="col-md-8">
                        <div class="category my-2"><?= htmlspecialchars($categoryNews[5]['category_name']);?></div>
                        <div class="card-body">
                            <h5 class="card-title mb-3"><?= htmlspecialchars($categoryNews[5]['title']);?></h5>
                            <p class="description"><?= htmlspecialchars($categoryNews[5]['content']);?></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mt-5">
                <div class="d-flex justify-content-center align-items-center">
                    <img src="images/ad-placeholder.jpg" alt="إعلان" class="img-fluid">
                </div>
            </div>
        </div>
        
    </div>

    <?php include './partials/footer.php' ?>

</body>
</html>