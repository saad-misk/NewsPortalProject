<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>category-page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/category_page.css">
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>

    <?php include '../partials/nav.php'?>

    <div class="container mt-5">

        <div class="container d-flex justify-content-between border-bottom px-0 mb-5">
            <div class="fw-bold fs-4 pb-2">
                <span class="border-bottom border-4 border-primary">رياضة</span>    
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-8">
                <div class="square-card main-news mb-4">
                    <img src="images/worldCup.jpg" class="card-img-top img-fluid mb-2" alt="صورة كأس العالم">
                    <div class="category my-2">رياضة - العالم</div>
                    <div class="card-body">
                        <h5 class="card-title mb-2">احتفالاً بمئة عام على انطلاق البطولة.. مقترح لنسخة 2030 من كأس العالم</h5>
                        <p class="description">ستقام كأس العالم 2030 في المغرب وإسبانيا والبرتغال، بينما من المقرر أن تستضيف الأرجنتين...</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="square-card sub-news mb-3">
                    <img src="images/category-side-first.jpg" class="card-img-top" alt="إصابة الحارس نوير">
                    <div class="card-body">
                        <div class="category my-2">رياضة - المانيا</div>
                        <h6 class="card-title">الإصابة تبعد الحارس الألماني التاريخي نوير عن الملاعب.. كم سيغيب؟</h6>
                        <p class="text-muted">ستقام كأس العالم 2030 في المغرب وإسبانيا والبرتغال، بينما من المقرر أن تستضيف الأرجنتين...</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <img src="images/category-side-2.jpg" class="img-fluid" alt="موعد كأس العرب">
                    </div>
                    <div class="col-md-8">
                        <div class="category my-2">رياضة - قطر</div>
                        <div class="card-body">
                            <h6 class="card-title">فيفا يكشف موعد كأس العرب ومونديال الشباب في قطر</h6>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <img src="images/category-side-3.jpg" class="img-fluid" alt="موعد كأس العرب">
                    </div>
                    <div class="col-md-8">
                        <div class="category my-2">رياضة - اوروبا</div>
                        <div class="card-body">
                            <h6 class="card-title">فيفا يكشف موعد كأس العرب ومونديال الشباب في قطر</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>  

        <div class="row less-space">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4">
                        <img src="images/category-additional-first.jpg" class="img-fluid" alt="موعد كأس العرب">
                    </div>
                    <div class="col-md-8">
                        <div class="category my-2">العالم</div>
                        <div class="card-body">
                            <h5 class="card-title mb-3">فيفا يكشف موعد كأس العرب ومونديال الشباب في قطر</h5>
                            <p class="description">ستقام كأس العالم 2030 في المغرب وإسبانيا والبرتغال، بينما من المقرر أن تستضيف الأرجنتين...</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <img src="images/category-additional-second.jpg" class="img-fluid" alt="موعد كأس العرب">
                    </div>
                    <div class="col-md-8">
                        <div class="category my-2">العالم العربي</div>
                        <div class="card-body">
                            <h5 class="card-title mb-3">فيفا يكشف موعد كأس العرب ومونديال الشباب في قطر</h5>
                            <p class="description">ستقام كأس العالم 2030 في المغرب وإسبانيا والبرتغال، بينما من المقرر أن تستضيف الأرجنتين...</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="d-flex justify-content-center align-items-center">
                    <img src="images/ad-placeholder.jpg" alt="إعلان" class="img-fluid">
                </div>
            </div>
        </div>
        
    </div>

    <?php include './partials/footer.php' ?>

</body>
</html>