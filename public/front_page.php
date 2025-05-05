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
    <?php 
        require_once 'models/News.php';

        $newsModel = new News();
        $news = $newsModel->getAll();
        $news = array_slice($news, 0, 3);

    ?>
    <div class="container mt-4 pb-2 w-100">
        <div class="row">
            <div class="col-md-5 pb-2 mb-0">
                <div class="main-news pb-5">
                    <img src="images/front-page-1.jpg" class="image-fluid h-100 w-100" alt="...">
                    <div class="text-white description ps-2 pt-5 pb-5">
                        <span class="small">سياسة</span>
                        <h5 class="fw-bold my-3">الغزي ورحلة معاناته اليومية.. خطة إسرائيلية للسيطرة على مساعدات القطاع</h5>
                        <a href="./details_page.php" class="text-decoration-none text-white">
                            <p class="small">قدم الجيش الإسرائيلي للأمم المتحدة ولمنظمات الإغاثة خطة لإدارة المساعدات التي تدخل إلى غزة وتتضمن فرض سيطرة إسرائيلية أكثر...</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="side-news">
                            <img src="images/front-page-2.jpg" class="card-img-top img-fluid mb-2" alt="News Image">
                            <div class="card-body">
                                <span class="text-muted small">سياسة</span>
                                <p class="card-text fw-bold">"قائمة الأزمة".. مجلس الأمن يحذر من إنشاء سلطة حكم موازية في السودان</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="side-news">
                            <img src="images/front-page-3.jpg" class="card-img-top img-fluid mb-2" alt="News Image">
                            <div class="card-body">
                                <span class="text-muted small">سياسة</span>
                                <p class="card-text fw-bold">استشهاد أسير فلسطيني في سجون الاحتلال.. حماس تندد بـ"إعدام متعمد"</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="side-news">
                            <img src="images/front-page-4.jpg" class="card-img-top img-fluid mb-2" alt="News Image">
                            <div class="card-body">
                                <span class="text-muted small">مجتمع</span>
                                <p class="card-text fw-bold">في قلب مدينة دكا.. سوق نشون بازار يستقبل الصائمين منذ أكثر من 400 عام</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="side-news">
                            <img src="images/front-page-5.jpg" class="card-img-top img-fluid mb-2" alt="News Image">
                            <div class="card-body">
                                <span class="text-muted small">سياسة</span>
                                <p class="card-text fw-bold">موسكو تسعى للحفاظ على قواعدها في سوريا.. هل تسلم الأسد؟</p>
                            </div>
                        </div>
                    </div>
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
                    <li class="border-bottom py-1 d-flex align-items-center justify-content-between">
                        فيديو يزعم أنه لنقل نبات عسكرية إسرائيلية في شوارع دمشق.. ما حقيقته؟
                        <span class="number">1</span> 
                    </li>
                    <li class="border-bottom py-1 d-flex align-items-center justify-content-between">
                        تناول فيديو لمشاجرة بين مقاتلين أجانب في سوريا.. ما حقيقته؟
                        <span class="number">2</span>
                    </li>
                    <li class="border-bottom py-1 d-flex align-items-center justify-content-between">
                        أقصى عملاقة كرة في بلد لبنانية.. ما حقيقة الفيديو المتداول؟
                        <span class="number">3</span>
                    </li>
                    <li class="border-bottom py-1 d-flex align-items-center justify-content-between">
                        بشار الأسد في إعلان شوكولاتة يثير تفاعلاً.. هذا ما قيل عن اليوم صورته
                        <span class="number">4</span>
                    </li>
                    <li class="pt-1 d-flex align-items-center justify-content-between">
                        اختتام أعمال قمة القاهرة.. القادة العرب يعتمدون خطة مصر لإعمار غزة
                        <span class="number">5</span> 
                    </li>
                </ul>
            </div>
    
            <div class="col-md-8">
                <div class="d-flex justify-content-between border-bottom mb-2 pb-1 px-0">
                    <div class="fw-bold fs-4 mb-1">
                        <span class="border-bottom border-4 border-primary">المزيد من الاخبار</span>    
                    </div>
                    <a href="./details_page.php" class="text-decoration-none text-white">
                        <h6 class="text-primary">المزيد</h6>  
                    </a>     
                </div>
                
                <div class="row pt-3">
                    <div class="col-md-6">
                        <div class="card border-0">
                            <img src="images/front-page-6.jpg" class="card-img-top" alt="Main News">
                            <div class="card-body">
                                <span class="text-muted small">سياسة - العالم</span>
                                <h6 class="fw-bold mt-3">زيلينسكي يحاول إصلاح ما أفسد في البيت الأبيض.. كيف سيحتوي الأزمة؟</h6>
                                <p class="text-muted">الجمعة شهد اللقاء بين زيلينسكي وقادة البيت الأبيض، حيث طغت أجواء متوترة مع دخول البث المباشر في نقاش أمام الكاميرات.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="row">
                            <div class="container">
                                <div>
                                    <span class="text-muted small">رياضة - العالم</span>
                                    <p class="mt-2 mb-0">احتفالًا بمرور عام على انطلاق البطولة.. مقترح لاستضافة 2030 من كأس العالم</p>
                                </div>
                                <img src="images/front-page-7.jpg" width="100vw" height="60vw" alt="News">
                            </div>
                                
                        </div>
                        
                        <div class="row mt-3">
                            <div class="container">
                                <div>
                                    <span class="text-muted small">سياسة - العالم</span>
                                    <p class="mt-2 mb-0">وسط تهديدات ترهيب.. تدريبات جوية إسرائيلية أمريكية فوق البحر المتوسط</p>
                                </div>
                                <img src="images/front-page-8.jpg" width="100vw" height="60vw" alt="News">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="d-flex justify-content-between border-bottom pb-1 px-0">
            <div class="fw-bold fs-4 mb-1">
                <span class="border-bottom border-4 border-primary">سياسة</span>    
            </div>
            <a href=".category_page.html" class="text-decoration-none text-white">
                <h6 class="text-primary">المزيد</h6>  
            </a>  
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <img src="images/front-page-9.jpg" class="mb-2 w-100" alt="News">
                <span class="small text-muted">سياسة</span>
                <p class="fw-bold fs-5 mt-2">اتصالات ناشطة للوسطاء حماس: ملتزمون بكافة مراحل الاتفاق</p>
                <p class="text-muted fw-bold small">اكد المتحدث باسم حركة حماس ان الوسطاء يواصلون اتصالاتهم من اجل دفع تل ابيب الى البدء بمفاوضات المرحلة الثانية لاتفاق وقف..</p>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <img src="images/front-page-10.jpg" class="img-fluid mb-2" alt="News">
                        <span class="small text-muted">سياسة</span>
                        <h6 class="fw-bold mt-2">اتصالات ناشطة للوسطاء.. حماس: ملتزمون بكافة مراحل الاتفاق</h6>
                    </div>
                    <div class="col-md-6">
                        <img src="images/front-page-11.jpg" class="img-fluid mb-2" alt="">
                        <span class="small text-muted">سياسة</span>
                        <h6 class="fw-bold mt-2">اتصالات ناشطة للوسطاء.. حماس: ملتزمون بكافة مراحل الاتفاق</h6>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <img src="images/front-page-12.jpg" class="img-fluid mb-2" alt="">
                        <span class="small text-muted">سياسة</span>
                        <h6 class="fw-bold mt-2">اتصالات ناشطة للوسطاء.. حماس: ملتزمون بكافة مراحل الاتفاق</h6>
                    </div>
                    <div class="col-md-6">
                        <img src="images/front-page-13.jpg" class="img-fluid mb-2" alt="">
                        <span class="small text-muted">سياسة</span>
                        <h6 class="fw-bold mt-2">اتصالات ناشطة للوسطاء.. حماس: ملتزمون بكافة مراحل الاتفاق</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="d-flex justify-content-between border-bottom pb-1 px-0">
            <div class="fw-bold fs-4 mb-1">
                <span class="border-bottom border-4 border-primary">اقتصاد</span>    
            </div>
            <a href="#" class="text-decoration-none text-white">
                <h6 class="text-primary">المزيد</h6>  
            </a>     
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <img src="images/front-page-9.jpg" class="mb-2 w-100" alt="News">
                <span class="small text-muted">سياسة</span>
                <p class="fw-bold fs-5 mt-2">اتصالات ناشطة للوسطاء حماس: ملتزمون بكافة مراحل الاتفاق</p>
                <p class="text-muted fw-bold small">اكد المتحدث باسم حركة حماس ان الوسطاء يواصلون اتصالاتهم من اجل دفع تل ابيب الى البدء بمفاوضات المرحلة الثانية لاتفاق وقف..</p>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <img src="images/front-page-10.jpg" class="img-fluid mb-2" alt="News">
                        <span class="small text-muted">سياسة</span>
                        <h6 class="fw-bold mt-2">اتصالات ناشطة للوسطاء.. حماس: ملتزمون بكافة مراحل الاتفاق</h6>
                    </div>
                    <div class="col-md-6">
                        <img src="images/front-page-11.jpg" class="img-fluid mb-2" alt="">
                        <span class="small text-muted">سياسة</span>
                        <h6 class="fw-bold mt-2">اتصالات ناشطة للوسطاء.. حماس: ملتزمون بكافة مراحل الاتفاق</h6>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <img src="images/front-page-12.jpg" class="img-fluid mb-2" alt="">
                        <span class="small text-muted">سياسة</span>
                        <h6 class="fw-bold mt-2">اتصالات ناشطة للوسطاء.. حماس: ملتزمون بكافة مراحل الاتفاق</h6>
                    </div>
                    <div class="col-md-6">
                        <img src="images/front-page-13.jpg" class="img-fluid mb-2" alt="">
                        <span class="small text-muted">سياسة</span>
                        <h6 class="fw-bold mt-2">اتصالات ناشطة للوسطاء.. حماس: ملتزمون بكافة مراحل الاتفاق</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container mt-5">
        <div class="d-flex justify-content-between border-bottom pb-1 px-0">
            <div class="fw-bold fs-4 mb-1">
                <span class="border-bottom border-4 border-primary">صحة</span>    
            </div>
            <a href="#" class="text-decoration-none text-white">
                <h6 class="text-primary">المزيد</h6>  
            </a>    
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <img src="images/front-page-9.jpg" class="mb-2 w-100" alt="News">
                <span class="small text-muted">سياسة</span>
                <p class="fw-bold fs-5 mt-2">اتصالات ناشطة للوسطاء حماس: ملتزمون بكافة مراحل الاتفاق</p>
                <p class="text-muted fw-bold small">اكد المتحدث باسم حركة حماس ان الوسطاء يواصلون اتصالاتهم من اجل دفع تل ابيب الى البدء بمفاوضات المرحلة الثانية لاتفاق وقف..</p>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <img src="images/front-page-10.jpg" class="img-fluid mb-2" alt="News">
                        <span class="small text-muted">سياسة</span>
                        <h6 class="fw-bold mt-2">اتصالات ناشطة للوسطاء.. حماس: ملتزمون بكافة مراحل الاتفاق</h6>
                    </div>
                    <div class="col-md-6">
                        <img src="images/front-page-11.jpg" class="img-fluid mb-2" alt="">
                        <span class="small text-muted">سياسة</span>
                        <h6 class="fw-bold mt-2">اتصالات ناشطة للوسطاء.. حماس: ملتزمون بكافة مراحل الاتفاق</h6>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <img src="images/front-page-12.jpg" class="img-fluid mb-2" alt="">
                        <span class="small text-muted">سياسة</span>
                        <h6 class="fw-bold mt-2">اتصالات ناشطة للوسطاء.. حماس: ملتزمون بكافة مراحل الاتفاق</h6>
                    </div>
                    <div class="col-md-6">
                        <img src="images/front-page-13.jpg" class="img-fluid mb-2" alt="">
                        <span class="small text-muted">سياسة</span>
                        <h6 class="fw-bold mt-2">اتصالات ناشطة للوسطاء.. حماس: ملتزمون بكافة مراحل الاتفاق</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container mt-5">
        <div class="d-flex justify-content-between border-bottom pb-1 px-0">
            <div class="fw-bold fs-4 mb-1">
                <span class="border-bottom border-4 border-primary">رياضة</span>    
            </div>
            <a href="#" class="text-decoration-none text-white">
                <h6 class="text-primary">المزيد</h6>  
            </a>      
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <img src="images/front-page-9.jpg" class="mb-2 w-100" alt="News">
                <span class="small text-muted">سياسة</span>
                <p class="fw-bold fs-5 mt-2">اتصالات ناشطة للوسطاء حماس: ملتزمون بكافة مراحل الاتفاق</p>
                <p class="text-muted fw-bold small">اكد المتحدث باسم حركة حماس ان الوسطاء يواصلون اتصالاتهم من اجل دفع تل ابيب الى البدء بمفاوضات المرحلة الثانية لاتفاق وقف..</p>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <img src="images/front-page-10.jpg" class="img-fluid mb-2" alt="News">
                        <span class="small text-muted">سياسة</span>
                        <h6 class="fw-bold mt-2">اتصالات ناشطة للوسطاء.. حماس: ملتزمون بكافة مراحل الاتفاق</h6>
                    </div>
                    <div class="col-md-6">
                        <img src="images/front-page-11.jpg" class="img-fluid mb-2" alt="">
                        <span class="small text-muted">سياسة</span>
                        <h6 class="fw-bold mt-2">اتصالات ناشطة للوسطاء.. حماس: ملتزمون بكافة مراحل الاتفاق</h6>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <img src="images/front-page-12.jpg" class="img-fluid mb-2" alt="">
                        <span class="small text-muted">سياسة</span>
                        <h6 class="fw-bold mt-2">اتصالات ناشطة للوسطاء.. حماس: ملتزمون بكافة مراحل الاتفاق</h6>
                    </div>
                    <div class="col-md-6">
                        <img src="images/front-page-13.jpg" class="img-fluid mb-2" alt="">
                        <span class="small text-muted">سياسة</span>
                        <h6 class="fw-bold mt-2">اتصالات ناشطة للوسطاء.. حماس: ملتزمون بكافة مراحل الاتفاق</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <?php include './partials/footer.php' ?>
</body>
</html>