<?php 
    include 'connect.php';
    include 'connect.php';
    include 'helpers.php';
    $get = $con->prepare('SELECT * FROM projects  LIMIT 3 ');
    $get->execute(array());
    $projectsInfo = $get->fetchAll();

    // Get Reviews 
    $userReviews = getData('0', "approval", '*', 'reviews', $con);

?>
<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,700;1,300&family=Rubik:ital,wght@0,300;0,400;0,500;0,700;1,300&family=Space+Mono:ital,wght@0,400;0,700;1,700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@v2.15.1/devicon.min.css">
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="css/all.min.css"/>
    <link rel="stylesheet" href="css/style.css?time=<?php echo time()?>">
    <title>Home</title>
</head>
<body>
    <a href="https://t.me/DarkCode2o2" class="telegram-icon" target="_blank">
        <i class="fa-brands fa-telegram"></i>
    </a>
    <header>
        <div class="my-cont">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <a class="navbar-brand" href="index.php">Dark Code</a>
                <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                    <ul class="navbar-nav mr-5">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php">الصفحة الرئيسية</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">عنّا</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="services.php">الخدمات</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="projects.php">المشاريع</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="reviews.php">آراء العملاء</a>
                        </li>
                    </ul>

                    <div class="head-box">
                        <a href="contact.php" class="contact shadow"> 
                            <span>أطلب خدمة</span>
                            <svg class="svg-inline--fa fa-paper-plane fa-w-16 contact-icon mr-md-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="paper-plane" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M476 3.2L12.5 270.6c-18.1 10.4-15.8 35.6 2.2 43.2L121 358.4l287.3-253.2c5.5-4.9 13.3 2.6 8.6 8.3L176 407v80.5c0 23.6 28.5 32.9 42.5 15.8L282 426l124.6 52.2c14.2 6 30.4-2.9 33-18.2l72-432C515 7.8 493.3-6.8 476 3.2z"></path></svg>
                        </a>

                       <?php if(checker() !== 1) { ?>

                            <a href="login.php#form" class="login"> 
                                <span>تسجيل دخول</span>
                                <i class="fa-solid fa-arrow-right-to-bracket"></i>
                            </a>

                        <?php } ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div class="homepage">
  
        <img alt="" src="images/herobgc.webp" decoding="async" data-nimg="fill" class="object-bottom" loading="lazy" style="position: absolute; height: 100%; width: 100%; inset: 0px; object-fit: cover; color: transparent;">
        <div class="my-cont">
           <div class="content">
                <div class="">
                    <h5>مرحبًا</h5>
                    <img alt="waving-hand" src="images/waving-hand.1da6fc7a.gif" width="30" height="30" decoding="async" data-nimg="1" loading="lazy" style="color: transdivarent;">
                </div>
                <h2>
                انا Dark Code &#128516
                </h2>
                <div class="auto-type">
                    <p class="typing"></p>
                </div>
                <a href="https://t.me/DarkCode2o2" target="_blank"><i class="fa-solid fa-chevron-right ms-1"></i>ابدأ مشروعك</a>
           </div>
           <div class="hero-img">
                <img src="images/back.png" alt="" class="img-fluid">
           </div>
        </div>
    </div>
    <!-- Start Show Skills -->
    <div class="show-skills">
        <div class="my-cont">
            <div class="title">
                <h2>
                    قسم المهارات
                    <i class="fa-solid fa-code"></i>
                </h2>
            </div>
            <div class="toggles">
                <span data-type="all" class="clicked">الكل</span>
                <span data-type="frontend">الواجهة الامامية</span>
                <span data-type="backend">الواجهة الخلفية</span>
                <span data-type="other">أخرى</span>
            </div>
            <div class="skills-box">
                <div class="skill" data-type="frontend">
                    <i class="devicon-javascript-plain colored"></i>
                    <p>JavaScript</p>
                </div>
                <div class="skill" data-type="frontend">
                    <i class="devicon-html5-plain colored"></i>
                    <p>HTML5</p>
                </div>
                <div class="skill" data-type="frontend">
                    <i class="devicon-css3-plain colored"></i>
                    <p>CSS3</p>
                </div>
                <div class="skill" data-type="frontend">
                    <i class="devicon-bootstrap-plain colored"></i>
                    <p>Bootstrap</p>
                </div>
                <div class="skill" data-type="frontend">
                    <i class="devicon-tailwindcss-plain colored"></i>
                    <p>Tailwindcss</p>
                </div>
                <div class="skill" data-type="frontend">
                    <i class="devicon-jquery-plain colored"></i>
                    <p>Jquery</p>
                </div>
                <div class="skill" data-type="backend">
                    <i class="devicon-php-plain colored"></i>
                    <p>PHP</p>
                </div>
                <div class="skill" data-type="backend">
                    <img src="images/laravel.svg" style="width: 80px; height:80px;" alt="" class="img-fluid">
                    <p>Laravel</p>
                </div>
                <div class="skill" data-type="backend">
                    <i class="devicon-mysql-plain colored"></i>
                    <p>MySQL</p>
                </div>
                <div class="skill" data-type="other">
                    <i class="devicon-git-plain colored"></i>
                    <p>Git</p>
                </div>
                <div class="skill" data-type="other">
                    <i class="devicon-github-plain colored"></i>
                    <p>GitHub</p>
                </div>
                <div class="skill" data-type="other">
                    <img src="https://img.icons8.com/?size=1x&id=17949&format=png" alt="">
                    <p>Googling</p>
                </div>
                <div class="skill" data-type="other">
                    <img src="https://img.icons8.com/?size=1x&id=qvcWKkhudkhd&format=png" alt="">
                    <p>Fast Typing</p>
                </div>
                <div class="skill bg-transparent" data-type="other">
                    <i class="fa-solid fa-terminal fs-1" style="width: 80px; height: 80px;"></i>
                    <p>Terminal</p>
                </div>
            </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#fafafa" class="shape-bottom">
            <path class="shape-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
            c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
            c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
        </svg>
    </div>
    <!-- End Show Skills -->
    <!-- Start brief -->
    <div class="brief">
        <div class="my-cont">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#fafafa" class="shape-top">
                <path class="shape-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
                c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
                c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
            </svg>
            <div class="title">
                <h2>نحن نقدم افضل خدمة رقمية</h2>
            </div>
            <div class="provide">
                <div class="content">
                    <p>
                        - بتخصصي في تطوير الويب وتصميم الواجهة، ستحصل على موقع ويب مميز يلفت الانتباه ويثير الإعجاب. أضمن تجربة مستخدم رائعة تتوافق مع أهداف عملك.
                    </p>
                    <p>
                        - سواء كنت بحاجة إلى تصميم واجهة جذابة وسهلة الاستخدام، أو تطبيق ويب يشد انتباه جمهورك، أو حلاً مخصصًا لعملك يعزز من سير العمل، انا اقدم حلاً مبتكرًا يلبي تلك الاحتياجات.
                    </p>
                </div>
                <div class="image">
                    <img src="images/brief_img.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- End brief  -->
    <!-- Start rights  -->
    <div class="rights">
        <div class="my-cont">
            <div class="title">
                <h2>كيف أضمن حقي ؟ </h2>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#fafafa" class="shape-bottom">
                <path class="shape-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
                c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
                c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
            </svg>
            <div class="client-rights">
                <div class="content">
                    <p>
                    في عملي الفردي، أضمن تقديم خدمة آمنة وموثوقة لجميع عملائي. أستخدم نهجًا فريدًا حيث يتلقى العميل الطلب على شكل فيديو مفصل يشرح جميع مواصفات المشروع. تُعزز هذه الطريقة من الثقة لدى عملائي فيما يتعلق بجودة الخدمة التي أقدمها، مضمونًا بأنهم سيحصلون على المشروع على المستوى المطلوب من الجودة قبل التزامهم المالي. بالإضافة إلى ذلك، أمنح أولوية عالية لتقديم دعم فني ممتاز لضمان رضا العملاء. <span>🚀</span>
                    </p>
                   
                </div>
                <div class="image">
                    <img src="images/garntiy.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- End rights  -->
    <!-- Start Projcts  -->
    <div class="recent-works">
        <div class="my-cont">
            <div class="title" id="pro">
                <h2>من أعمالي</h2>
            </div>
            <div class="boxes">
                <?php foreach($projectsInfo as $proInfo) { ?>
                    <div class="box">
                        <div class="img">
                            <img src="uploads/projects_image/<?php echo $proInfo['image']?>" alt="">
                            <div class="links">
                                <a href="project.php?page=<?php echo $proInfo['project_id']?>">
                                    <i class="fa-solid fa-expand"></i>
                                </a>
                            </div>   
                        </div>    
                        <div class="content">
                            <h3><?php echo $proInfo['title']?></h3>
                            <p><?php echo $proInfo['content']?></p>
                        </div>    
                    </div>
                <?php }?>      
            </div>
            <a href="projects.php#pro" class="btn btn-primary fw-bold">عرض الكل</a>

        </div>
    </div>
    <!-- End Projcts  -->
    <!-- Start Opinions  -->
    <div class="opinions">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#fafafa" class="shape-top">
                <path class="shape-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
                c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
                c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
            </svg>
            <?php if(!empty($userReviews)) :?>
            <div class="title">
                <h2>
                    آراء العملاء
                    <i class="fa-regular fa-comments"></i>
                </h2>
            </div>
            <!-- Swiper -->
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <?php foreach($userReviews as $review):?>
                            <div class="swiper-slide">
                                <p>
                                    <?php echo $review['content'] ?>
                                </p>
                                <div class="stars">
                                    <?php  for ($i = 0; $i < 5; $i++):
                                            if ($i < $review['rating']): ?>
                                                <span><i class="fa-solid fa-star"></i></span>
                                            <?php
                                                continue;
                                            endif ?>
                                            <span><i class="fa-regular fa-star"></i></span>
                                    <?php endfor;

                                    if($review['approval'] == 0) { ?>
                                        <a href="reviews.php?id=<?php echo $review['id']?>&type=approval" class="approve-btn">Approval</a>
                                    <?php }?>
                                </div>
                                <div class="userInfo">
                                    <div>
                                        <h3><?php echo $review['name']?></h3>
                                        <span><?php echo $review['city']?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            <?php endif?>
    </div>
    <!-- End Opinions  -->

<?php include 'footer.php' ?>