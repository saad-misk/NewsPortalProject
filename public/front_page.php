<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Front-page</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-DOXMLfHhQkvFFp+rWTZwVlPVqdIhpDVYT9csOnHSgWQWPX0v5MCGtjCJbY6ERspU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/front_page.css">

</head>
<body>
    <?php include './partials/nav.php'?>

    <div class="container mt-4 pb-2 w-100">
        <div class="row">
            <?php
                require_once '../models/News.php';
                $newsModel = new News();
                $featuredNews = $newsModel->getFeaturedNews(5);                    
            ?>
            <div class="col-md-5 pb-2 mb-0">
                <div class="main-news pb-5">
                    <img src="<?= $featuredNews[0]['thumbnail_url'] ?>" class="image-fluid h-100 w-100" alt="...">
                    <div class="text-white description ps-2 pt-5 pb-5">
                        <span class="small"> <?= $featuredNews[0]['category_name'] ?></span>
                        <h5 class="fw-bold my-3"><?=$featuredNews[0]['title']?></h5>
                        <a href="./details_page.php?<?= $featuredNews[0]['id'] ?>" class="text-decoration-none text-white">
                            <p class="small"><?=substr($featuredNews[0]['content'], 0, 100)?>...</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="row">
                    <?php for ($i = 1; $i < 5; $i++): 
                        if(isset($featuredNews[$i])): ?>
                            <div class="col-md-6 mb-3">
                                <div class="side-news">
                                    <img src="<?= $featuredNews[$i]['thumbnail_url'] ?>" class="card-img-top img-fluid mb-2" alt="News Image">
                                    <div class="card-body">
                                        <span class="text-muted small"><?= $featuredNews[$i]['category_name'] ?></span>
                                        <a href="details_page.php?id=<?= $featuredNews[$i]['id'] ?>" class="text-decoration-none text-dark">
                                            <h6 class="fw-bold mt-3"><?=$featuredNews[$i]['title']?></h6> 
                                        </a>
                                        
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endfor; ?>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="fw-bold fs-4 mb-2">
                    <span class="border-bottom border-4 border-primary">الأكثر قراءة</span>    
                </div>
                <ul class="list-unstyled border-top pt-2">
                    <?php 
                    require_once '../models/News.php';
                    $newsModel = new News();
                    $mostRead = $newsModel->getMostRead(5);
                    $counter = 1;
                    foreach ($mostRead as $article): ?>
                    <li class="border-bottom py-1 d-flex align-items-center justify-content-between">
                        <a href="details_page.php?id=<?= $article['id'] ?>" class="text-decoration-none text-dark">
                            <?=$article['title']?>
                        </a>
                        <span class="number"><?= $counter ?></span>
                    </li>
                    <?php $counter++; endforeach; ?>
                </ul>

                <div class="fw-bold fs-4 mb-2 mt-4">
                    <span class="border-bottom border-4 border-primary">الأكثر تعليقًا</span>    
                </div>
                <ul class="list-unstyled border-top pt-2">
                    <?php 
                    $mostCommented = $newsModel->getMostCommented();
                    foreach ($mostCommented as $article): ?>
                    <li class="border-bottom py-2">
                        <a href="details_page.php?id=<?= $article['id'] ?>" class="text-decoration-none text-dark">
                            <?=$article['title']?>
                        </a>
                        <div class="text-muted small mt-1">
                            <span>التعليقات: <?= $article['comment_count'] ?></span>
                            <?php if ($article['last_comment']): ?>
                            <div class="comment-preview">
                                آخر تعليق: <?=substr($article['last_comment'], 0, 40)?>...
                            </div>
                            <?php endif; ?>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="col-md-8">
                <div class="d-flex justify-content-between border-bottom mb-2 pb-1 px-0">
                    <div class="fw-bold fs-4 mb-1">
                        <span class="border-bottom border-4 border-primary">أخبار أخرى</span>    
                    </div>
                    <a href="./all_news.php" class="text-decoration-none text-white">
                        <h6 class="text-primary">المزيد</h6>  
                    </a>     
                </div>
                
                <div class="row pt-3">
                    <?php 
                    require_once '../models/News.php';
                    $newsModel = new News();
                    $sideNews = $newsModel->getSideNews(4);
                    foreach ($sideNews as $news): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card border-0 h-100">
                            <a href="details_page.php?id=<?= $news['id'] ?>">
                                <img src="<?= $news['thumbnail_url'] ?>" class="card-img-top" alt="<?=$news['title']?>">
                            </a>
                            <div class="card-body">
                                <span class="text-muted small"><?= $news['category_name'] ?></span>
                                <h6 class="fw-bold mt-2">
                                    <a href="details_page.php?id=<?= $news['id'] ?>" class="text-dark text-decoration-none">
                                        <?=$news['title']?>
                                    </a>
                                </h6>
                                <p class="text-muted small">
                                    <?=substr($news['content'], 0, 80)?>...
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <?php 
        require_once '../models/Category.php';
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        foreach ($categories as $category): 
            $latestNews = $newsModel->getLatestByCategory($category['id'], 5);
            if(count($latestNews) === 0) continue; // Skip empty categories
        ?>
        <div class="container mt-5">
            <div class="d-flex justify-content-between border-bottom pb-1 px-0">
                <div class="fw-bold fs-4 mb-1">
                    <span class="border-bottom border-4 border-primary">
                        <?= $category['name'] ?>
                    </span>    
                </div>
                <a href="category_page.php?id=<?= $category['id'] ?>" class="text-decoration-none text-white">
                    <h6 class="text-primary">المزيد</h6>  
                </a>  
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <a href="details_page.php?id=<?= $latestNews[0]['id'] ?>" >
                        <img src="<?= $latestNews[0]['thumbnail_url'] ?>" class="mb-2 w-100" alt="<?= $latestNews[0]['title'] ?>">
                    </a>
                    <span class="small text-muted"><?= $category['name'] ?></span>
                    <a href="details_page.php?id=<?= $latestNews[0]['id'] ?>" class="text-decoration-none text-dark">
                        <p class="fw-bold fs-5 mt-2"><?=$latestNews[0]['title']?></p>
                    </a>
                    <a href="details_page.php?id=<?= $latestNews[0]['id'] ?>" class="text-decoration-none text-dark">
                        <p class="text-muted fw-bold small"><?=substr($latestNews[0]['content'], 0, 100)?>...</p>
                    </a>
                </div>
                
                <div class="col-md-6">
                    <div class="row">
                        <?php for ($i = 1; $i < 5; $i++): 
                            if(isset($latestNews[$i])): ?>
                            <div class="col-md-6 mb-3">
                                <a href="details_page.php?id=<?= $latestNews[$i]['id'] ?>">
                                    <img src="<?= $latestNews[$i]['thumbnail_url'] ?>" class="img-fluid mb-2" alt="<?= $latestNews[$i]['title'] ?>">
                                </a>
                                <span class="small text-muted"><?= $category['name'] ?></span>
                                <a href="details_page.php?id=<?= $latestNews[$i]['id'] ?>" class="text-decoration-none text-dark">
                                    <h6 class="fw-bold mt-2"><?=$latestNews[$i]['title']?></h6>
                                </a>
                            </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    

    <?php include './partials/footer.php' ?>
</body>
</html>