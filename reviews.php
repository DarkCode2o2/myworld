<?php
    ob_start();
    $pageTitle = 'تصفح تجارب وآراء عملائنا وتفاصيل شهاداتهم الشخصية حول تجربتهم معنا.';
    include 'header.php';
    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = htmlspecialchars($_POST['reviewer_name']);
        $city = htmlspecialchars($_POST['reviewer_city']);
        $content = htmlspecialchars($_POST['reviewer_content']);
        $rating = htmlspecialchars($_POST['rating']);

        $errors_form = array();

        if(strlen($name) < 4) {
            $errors_form[] =  "اسم المرور لا يمكن ان يكون اصغر من اربع خانات";
        }else if (empty($name)) {
            $errors_form[] =  "يرجى إدخال الإسم";
        }

        if (empty($city)) {
            $errors_form[] =  "يرجى إدخال المدينة ";
        }

        if (empty($content)) {
            $errors_form[] =  "يرجى إدخال رسالتك ";
        }

        if(empty($errors_form)) {
            $sql = $con->prepare("INSERT INTO reviews (name, city, content, rating, date) 
                                VALUES (?, ?, ?, ?, NOW())");
            $sql->execute(array($name, $city, $content, $rating));

            if($sql) {
                $_SESSION['msg'] = 'تم الإضافة بنجاح، سيتم مراجعته من قبل المشرف';
            }
        }

    }

    $reviews = getData('1', "approval", '*', 'reviews', $con);
?>
    <div class="reviews">
        <div class="container">
            <?php 
                if(count($reviews) > 6) {
                    echo '<a href="#review-form" class="review-btn">اضافة رأي <i class="fa-solid fa-pencil"></i></a>';
                }
            ?>
            <div class="boxes">
                <?php if(!empty($reviews)) {?>
                    <?php foreach($reviews as $review):?>
                        <div class="box">
                            <div class="stars">

                                <?php  for ($i = 0; $i < 5; $i++):
                                        if ($i < $review['rating']): ?>
                                            <span><i class="fa-solid fa-star"></i></span>
                                        <?php
                                            continue;
                                        endif ?>
                                        <span><i class="fa-regular fa-star"></i></span>
                                <?php endfor?>
                            </div>
                            <p>
                                <?php echo $review['content'] ?>
                            </p>
                            <div class="userInfo">
                                <img src="images/profile.png" alt="">
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
                <?php }else  {?>
                    <h3 class="text-center text-danger fs-1">ليس هنالك آراء لعرضها <i class="fa-regular fa-face-frown-open"></i></h3>
                <?php }?>
            </div>
            <form action="" method="POST" id="review-form">
                <h3>رأيك يهمنا</h3>
                <?php if(!empty($errors_form)) {
                    foreach($errors_form as $errors) {
                    ?>
                    <p class="error msg"><?php echo $errors?></p>
                <?php }
                }?>

                <?php if(!empty($_SESSION['msg'])) {?>
                    <p class="success2 msg"><?php echo $_SESSION['msg']?></p>
                    <?php $_SESSION['msg'] = ''?>
                <?php }?>
                <div>
                    <div>
                        <label>الإسم</label>
                        <input type="text" name="reviewer_name" minlength="3" placeholder="الإسم بالكامل" required>
                        <p class="strike">*</p>
                    </div>
                    <div>
                        <label>المدينة \ الدولة</label>
                        <input type="text" name="reviewer_city" placeholder="أكتب مدينتك او الدولة" required>
                        <p class="strike">*</p>
                    </div>
                </div>

                <div class="textarea">
                    <label class="mb-2 inline-block">رأي العميل</label>
                    <textarea name="reviewer_content" placeholder="أكتب رأيك..." minlength="2" maxlength="100" required></textarea>
                    <p class="strike">*</p>
                </div>
                <div>
                    <label> (القيمة الأفتراضية هي 5 نجوم)</label>
                    <div class="star_review">
                        <span><i class="fa-solid fa-star" data-rating="0"></i></span>
                        <span><i class="fa-solid fa-star" data-rating="1"></i></span>
                        <span><i class="fa-solid fa-star" data-rating="2"></i></span>
                        <span><i class="fa-solid fa-star" data-rating="3"></i></span>
                        <span><i class="fa-solid fa-star" data-rating="4"></i></span>
                    </div>                        
                </div>
                <input type="hidden" name="rating" id="ratingValue" value="5">
                <input type="submit" value="إرسال">
            </form>
        </div>
    </div>
<?php 
    include 'footer.php';
    ob_end_flush();
    ?>
