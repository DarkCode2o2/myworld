<?php 

    include 'connect.php';

    $pageid = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 0;
    
    if($pageid != 0) { 
        $get = $con->prepare('SELECT * FROM projects WHERE project_id = ? limit 1');
        $get->execute(array($pageid));
        $proInfo = $get->fetch();
    }else {
        header("Location: index.php");
        exit();
    }


   //   Start Add Comment 
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $comment    = htmlspecialchars($_POST['comment']);
        $userid     = $_COOKIE['userid'];
        $projectid  = $proInfo['project_id'];
        
        if(!empty($comment)) {
            $stmt = $con->prepare("INSERT INTO comments (comment, created_at, user_id, project_id) 
                            VALUES (?,now(), ?, ?) ");
            $stmt->execute(array($comment, $userid, $projectid));
      
            header("Location:project.php?page=$pageid#comments");
            exit;

        }else {
            $error = "<div class='p-2 text-danger fw-bold msg'>يرجى اضافة تعليق!</div>";
        }        
    }?>

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

    <div class="project">
        <div class="my-cont">
            <div class="show-pro">
                <div class="image">
                    <img src="uploads/projects_image/<?php echo $proInfo['image']?>" alt="">
                </div>
                <div class="content">
                    <h2>
                       <?php echo $proInfo['title']?>
                    </h2>
                    <p>
                        <?php echo $proInfo['content']?>
                    </p>
                    <?php if(!empty($proInfo['show_pro'])) { ?> 
                        <a href="https://<?php echo $proInfo['show_pro']?>" target="_blank">زيارة الموقع <i class="fa-solid fa-expand"></i> </a>
                    <?php }?>
                </div>
            </div>
             

                 <!-- Start Insert Comment -->
                 <div class="row" id="comments">
                    <div class="my-5 p-4 comments-area bg-light rounded">
                        <?php if(checker()) {?>
                            <form action="" method="POST" class="w-100 p-0 d-flex justify-content-center align-items-center">
                                <input type="text" name="comment" placeholder="اكتب تعليق...." class="form-control" autocomplete="off">
                                <input type="submit" value="إضافة تعليق">
                            </form>
                            <?php echo $error ?? null ?>       
                        <?php }else {
                            echo "<p>يجب عليك تسجيل الدخول لإضافة تعليق <a href='login.php?page=login#form'>تسجيل دخول</a></p>";
                        }?>            
                    <!-- End Insert Comment -->
                    <hr>
                    <!-- Start Show Comments -->
                    <?php 
                        $get = $con->prepare("SELECT comments.*, 
                                                    users.username AS username,
                                                    users.user_id AS userid,
                                                    users.avatar AS avatar
                                                    FROM comments 
                                                    INNER JOIN 
                                                    users
                                                    ON comments.user_id = users.user_id
                                                    WHERE comments.project_id = ?  ORDER BY comments.comment_id DESC
                                                ");
                        $get->execute(array($pageid));

                        $comments = $get->fetchAll();

                        if(!empty($comments)) {
                            foreach($comments as $comment) { ?>    
                                <div class="comment-box d-flex align-items-start">
                                    <?php 
                                        if(empty($comment['avatar'])) {
                                            echo "<img src='images/default.jpg' class='img-fluid'>";
                                        }else {
                                            echo "<img src='uploads/avatars/".$comment['avatar']."' class='img-fluid'>";
                                        }
                                    ?>
                                    <div class="comment-content">
                                        <h5><?php echo $comment['username']?></h5>
                                        <span class='card-date'><?php 
                                    $date = date_create($comment['created_at']);
                                    echo date_format($date, 'M d, Y')
                                ?></span>
                                        <p><?php echo $comment['comment']?></p>
                                    </div>
                                </div>
                                
                            <?php }
                        }else {
                            echo "<p>ليس هنالك تعليقات بعد</p>";
                        }
                    ?>
                    <!-- End Show Comments -->
                </div>
            </div>
            <!-- End Add Comment -->
        </div>
    </div>



<?php include 'footer.php'?>
