<?php 
    include 'connect.php';
    include 'helpers.php';
?>
<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@v2.15.1/devicon.min.css">
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="css/all.min.css"/>
    <link rel="stylesheet" href="css/style.css?time=<?php echo time()?>">
    <title>Home</title>
</head>
<body>
    <a href="#" class="telegram-icon" target="_blank">
        <i class="fa-brands fa-telegram"></i>
    </a>
    <header>
        <div class="my-cont">
        <nav class="navbar navbar-expand-lg bg-body-tertiary others">
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
    <div class="hero">
        <div class="paths">
            <div class="links">
                <a href="index.php">Home</a>
                <i class="fa-solid fa-angles-right"></i>
                <p class="link-1"></p>
            </div>
            <p><?php echo getTitle()?></p>
        </div>
    </div>