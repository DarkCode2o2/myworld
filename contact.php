<?php 

    session_start();
    include 'header.php';
    include 'connect.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $fname = htmlspecialchars($_POST['fname']);
        $lname = htmlspecialchars($_POST['lname']);
        $email = htmlspecialchars($_POST['email']);
        $text = htmlspecialchars($_POST['textarea']);

        if(empty($fname)) {
            $_SESSION['f_error'] = "<p class='error msg'>يرجى إدخال الأسم الأول!</p>";
        }
        if(empty($lname)) {
            $_SESSION['l_error'] = "<p class='error msg'>يرجى إدخال الأسم الأخير!</p>";
        }

        if(!empty($text) &&  strlen($text) < 10) {
            $_SESSION['text_error'] = "<p class='error msg'>يجب ان يكون الوصف اكثر من 10 أحرف</p>";
        }
       if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['email_error'] = "<p class='error msg'>يرجى إدخال بريد إلكتروني صالح!</p>";
       }

       $errors_form = array(); 
       $error = array(); 

       $errors_form[] = isset($_SESSION['f_error']) ? $_SESSION['f_error'] : '';
       $errors_form[] = isset($_SESSION['l_error']) ? $_SESSION['l_error'] : '';
       $errors_form[] = isset($_SESSION['text_error']) ? $_SESSION['text_error'] : '';
       $errors_form[] = isset($_SESSION['email_error']) ? $_SESSION['email_error'] : '';

       function errors($checker) {

            foreach($checker as  $val) {
                if(!empty($val)) {
                    return false;
                }
            }
            return true;
       }

       
       if(errors($errors_form)) {
            $sql = $con->prepare("INSERT INTO orders (firstname, lastname, email, content, created_at) VALUES (?, ?, ?, ?, NOW())");
            $sql->execute(array($fname, $lname, $email, $text));
    
            $_SESSION['success_msg'] = "<p class='alert alert-success msg mt-2'>تم إرسال بياناتك بنجاح</p>";
       }      

       header("location: contact.php#form");
       exit;
    }

?>

    <!-- Start Contact  -->

    <div class="contact-me">
        <div class="my-cont">
            <div class="title" id="form">
                <h2>تواصل معي</h2>
            </div>
            <div class="contact-box">
                <div class="image">
                    <img src="images/contact.png" alt="">
                </div>
                <form action="<?php $_SERVER['PHP_SELF']?>#form" method="POST">
                    <div class="names">
                        <div class="col-6">
                        <label>الاسم الأول</label>
                            <div>
                                <input type="text" name="fname" class="form-control" placeholder="أسمك الأول">
                                <span class="strike">*</span>
                            </div>
                            <?php 
                                echo !empty($_SESSION['f_error']) ? $_SESSION['f_error'] : '';
                                unset($_SESSION['f_error']);
                            ?>
                        </div>
                        <div class="col-6">
                            <label>الاسم الأخير</label>
                            <div>
                                <input type="text" name="lname" class="form-control" placeholder="أسمك الأخير">
                                <span class="strike">*</span>
                            </div>
                            <?php 
                                echo !empty($_SESSION['l_error']) ? $_SESSION['l_error'] : '';
                                unset($_SESSION['l_error']);
                                ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <label>البريد الألكتروني</label>
                        <div>
                            <input type="email" name="email" class="form-control" placeholder="مثال: example.com">
                            <span class="strike">*</span>
                            <?php 
                                echo !empty($_SESSION['email_error']) ? $_SESSION['email_error'] : '';
                                unset($_SESSION['email_error']);
                            ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <label>نص الرسالة</label>
                        <div>
                            <textarea name="textarea" class="form-control" placeholder="أكتب كافة تفاصيل طلبك..."></textarea>
                        </div>
                        <?php 
                            echo !empty($_SESSION['text_error']) ? $_SESSION['text_error'] : '';
                            unset($_SESSION['text_error']);
                            ?>
                    </div>
                    <?php 
                        echo !empty($_SESSION['success_msg']) ? $_SESSION['success_msg'] : '';
                        unset($_SESSION['success_msg']);
                        ?>
                    <input type="submit" value="إرسال" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>

    <!-- End Contact  -->

<?php include 'footer.php'?>
