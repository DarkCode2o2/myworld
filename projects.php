<?php 
    $pageTitle = 'تصفح مشاريعي التي أنجزتها وتعرف على تفاصيل إنجازاتي وأعمالي المتميزة.';
    include 'header.php';
    include 'connect.php';


    $get = $con->prepare('SELECT * FROM projects ORDER BY project_id DESC');
    $get->execute(array());
    $projectsInfo = $get->fetchAll();

?>

    <!-- Start Projcts  -->
    <div class="projects">
        <div class="my-cont">
            <div class="title" id="pro">
                <h2>المشاريع</h2>
            </div>
            <div class="boxes">
            <?php 
                if(!empty($projectsInfo)) {
                    foreach($projectsInfo as $proInfo) { 
            ?>
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
                            <div class="comment">
                                <a href="project.php?page=<?php echo $proInfo['project_id']?>#comments">
                                    <i class="fa-solid fa-comments"></i>
                                </a>
                                <span><?php 
                                    $date = date_create($proInfo['created_at']);
                                    echo date_format($date, 'l, M d, Y')
                                ?>
                            </span>
                            </div>
                        </div>
            <?php 
                    }
                }else {
                    echo "<h3 class='alert alert-info'>ليس هنالك مشاريع بعد</h3>";
                }
            ?>    
            </div>
        </div>
    </div>
    <!-- End Projcts  -->
<?php include 'footer.php'?>