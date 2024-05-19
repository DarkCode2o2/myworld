<?php 
    include 'header.php';
    include 'helpers.php';
    
    if(isset($_GET['not_approved'])) {
        $sql = $con->prepare("SELECT * FROM reviews WHERE approval = ? ORDER BY id DESC");
        $sql->execute([0]);
        $reviews = $sql->fetchAll();
    }else {
        $sql = $con->prepare("SELECT * FROM reviews ORDER BY id DESC");
        $sql->execute();
        $reviews = $sql->fetchAll();
        $_GET['all'] = 'active';
    }

?>
    <div class="reviews">
       <div class="container">
            <h3 class="main-title">إدارة اراء العملاء</h3>
            <div class="option">
                <i class="fa-solid fa-up-down"></i>
                <a href="?not_approved=active" class="<?php echo isset($_GET['not_approved']) ? 'active' : ''?>">غير موافق</a>
                <a href="?all=active" class="<?php echo isset($_GET['all']) ? 'active' : ''?>">الكل</a>
            </div>
            <?php if(!isset($_GET['type'])) {?>
                <div class="boxes">
                    <?php if(!empty($_SESSION['msg'])) {?>
                        <p class="success msg"><?php echo $_SESSION['msg']?></p>
                        <?php $_SESSION['msg'] = ''?>
                    <?php }?>
                    <?php foreach($reviews as $review):?>
                        <div class="box">
                            <a href="?id=<?php echo $review['id']?>&type=delete" class="delete-btn"><i class="fa-solid fa-circle-xmark"></i></a>
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
                            <p>
                                <?php echo $review['content'] ?>
                            </p>
                            <div class="userInfo">
                                <img src="../images/profile.png" alt="">
                                <div>
                                    <h3><?php echo $review['name']?></h3>
                                    <span><?php echo $review['city']?></span>
                                </div>
                            </div>
                            <span class="date">
                                <?php 
                                    $date = date_create($review['date']);
                                    echo date_format($date, 'M d, Y')
                                ?>
                            </span>
                        </div>
                    <?php endforeach?>
                </div>
            <?php }else if(isset($_GET['type']) && $_GET['type'] == 'approval') {
                    $id = $_GET['id'];
                    $sql = $con->prepare("UPDATE reviews SET approval = ? WHERE id = ?");
                    $sql->execute([1, $id]);

                    if($sql) {
                        $_SESSION['msg'] = "تم الموافقة بنجاح";
                        header("location: reviews.php");
                    }
                ?>
            <?php }else if(isset($_GET['type']) && $_GET['type'] == 'delete') {
                $id = $_GET['id'];
                $sql = $con->prepare("DELETE FROM reviews WHERE id = ?");
                $sql->execute(array($id));
                if($sql) {
                    $_SESSION['msg'] = "تم الحذف بنجاح";
                    header("location: reviews.php");
                }
                ?>

            <?php }?>
       </div>
    </div>
<?php include 'footer.php'?>