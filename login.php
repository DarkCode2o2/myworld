<?php 
    session_start();
    include 'connect.php';    

    $letters = str_split('abcdefghijklmnopqrstuvwxyz1234567890');
    $token = '';


    for($i = 0; $i < 30; $i++) {
        $token .= $letters[rand(0, 35)];
    }

    if(checker()) {
        header("location: index.php");
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {


        if(isset($_POST['login'])) {           
            $user = htmlspecialchars($_POST['username']);
            $pass = $_POST['password'];

            $get = $con->prepare("SELECT * FROM users WHERE username = ? AND password = ?");

            $get->execute(array($user, sha1($pass)));

            $userinfo = $get->fetch();

            $count = $get->rowCount();

            if ($count == 0) {
                $_SESSION['errorlog'] = "<span class='error msg'>خطأ في اسم المستخدم أو كلمة المرور!</span>";
                $redirect_to = 'login.php?page=login#form';
            }
            else {
            
                setcookie('token', $userinfo['token'], time() + 10 * 365 * 60 * 60);
                setcookie('userid', $userinfo['user_id'], time() + 10 * 365 * 60 * 60);
                $redirect_to = 'projects.php#pro';
            }
            
            header("Location: $redirect_to");
            exit;

        }else {
            
            $_SESSION['token'] = $token;

            $user = htmlspecialchars($_POST['username']);
            $pass = $_POST['password'];

            $errors_form = array();

            if(strlen($user) < 4) {

                $errors_form[] =  "اسم المرور لا يمكن ان يكون اصغر من اربع خانات";
            }
            if(strlen($pass) < 4) {

                $errors_form[] =  "كلمة المرور لا يمكن ان يكون اصغر من اربع خانات";
            }


            if(!empty($_FILES['avatar']['name'])) {
            
                $avatar_name = $_FILES['avatar']['name'];
                $avatar_type = $_FILES['avatar']['type'];
                $avatar_tmp = $_FILES['avatar']['tmp_name'];
                $avatar_size = $_FILES['avatar']['size'];
                $avatar_name_withoutSpace = str_replace(' ', '_', $avatar_name);
                $allowedType = array('png', 'jpg', 'jpeg', 'webp', 'gif');
                $avatarEx = explode('/', $avatar_type)[1];

                if(!in_array($avatarEx, $allowedType)) {

                    $errors_form[] = "خطأ في النوع الصورة!";             
                }

                $letters = str_split('abcdefghijklmnopqrstuvwxyz');
                $randomLetters = '';

                for($i = 0; $i < 20; $i++) {
                    $randomLetters .= $letters[rand(1, 20)];
                }

                $avatar = $randomLetters . '_'. $avatar_name_withoutSpace;
            }else {
                $avatar = '';
            }
            
            $_SESSION['error'] = $errors_form;


            
            if(empty($_SESSION['error'])) {

                $get = $con->prepare("SELECT username FROM users WHERE username = ?");

                $get->execute(array($user));
                $count = $get->rowCount();

                if($count == 0) {

                    $sql = $con->prepare("INSERT INTO users (username, password, avatar, token, created_at) VALUES (?, ?, ?, ?, now()) ");
                    $sql->execute(array($user, sha1($pass), $avatar, $token));

                    $_SESSION['success'] = "<p class='alert alert-success msg'>تم الإضافة بنجاح</p>";

                    
                    if($avatar) {
                        move_uploaded_file($avatar_tmp, "./uploads/avatars/". $avatar);
                    }

                }else {
                    $_SESSION['taken_name'] = '<span class="error msg">عذرا, هذا الأسم مستخدم بالفعل</span>';
                }
            }
            
            header("Location:login.php?page=signup#form");
            exit;
        }
        
    }

    $link = isset($_GET['page']) ? $_GET['page'] : 'login';?>

    <?php include 'header.php'; ?>
    <div class="login" id="form">
        <div class="my-cont">
            <?php if($link == 'login') { ?>
                <div class="title">
                    <h2>تسجيل الدخول</h2>
                </div>
                <form action="<?php echo $_SERVER['PHP_SELF']?>#form" method="POST">
                    <div class="row">
                        <label for="username" class="col-md-2 col-12 mb-md-0 mb-2">اسم المستخدم</label>
                        <div class="col-md-10 col-12">
                            <input type="text" name="username" id="username" class="form-control" required>
                            <span class="strike">*</span>
                        </div>
                        <label for="password" class="col-md-2 col-12 mb-md-0 mb-2">كلمة المرور</label>
                        <div class="col-md-10 col-12">
                            <input type="password" name="password" id="password" class="form-control" required>
                            <span class="strike">*</span>
                        </div>
                        <?php
                            if(isset($_SESSION['errorlog'])) {
                                echo "<p class='error msg'>". $_SESSION['errorlog'] ."</p>";
                                unset($_SESSION['errorlog']);
                            }
                        ?>
                        <span class="text-right">ليس لديك حساب بعد ؟ <a href="?page=signup#form">إنشاء حساب</a></span>
                        <input type="submit" value="تسجيل الدخول" class="btn btn-primary" name="login">
                    </div>
                </form>
                    
            <?php }elseif($link == 'signup') { ?>

                <div class="title">
                    <h2>إنشاء حساب</h2>
                </div>
                <form action="<?php echo $_SERVER['PHP_SELF']?>?page=signup#form" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <label class="col-md-2 col-12 mb-md-0 mb-2">أسم المستخدم</label>
                        <div class="col-md-10 col-12">
                            <input type="text" name="username" placeholder="اسم المستخدم" required autocomplete="off" class="form-control">
                            <span class="strike">*</span>
                        </div>
                        <?php 
                             if(!empty($_SESSION['taken_name'])) {
                                
                                echo $_SESSION['taken_name'];
                                unset($_SESSION['taken_name']);
                            }
                        ?>
                        <label class="col-md-2 col-12 mb-md-0 mb-2">كلمة المرور</label>
                        <div class="col-md-10 col-12">
                            <input type="password" name="password" placeholder="كلمة المرور" required class="form-control">
                            <span class="strike">*</span>

                        </div>
                        <label class="col-md-2 col-12 mb-md-0 mb-2 form-label">الصورة الشخصية</label>
                        <div class="col-md-10 col-12">
                            <input type="file" name="avatar" class="form-control">
                        </div>
                        <?php
                           if(!empty($_SESSION['error'])) {
                               foreach($_SESSION['error'] as $error) {
                                   echo "<p class='error msg'>$error</p>";
                                }
                                unset($_SESSION['error']);
                            }
                            if(!empty($_SESSION['success'])) {
                                echo $_SESSION['success'];
                                unset($_SESSION['success']);
                                
                            }
                        ?>
                        <span class="text-right">لديك حساب ؟ <a href="login.php#form">تسجيل دخول</a></span>
                        <input type="submit" value="أشتراك" class="btn btn-primary" name="signup">
                    </div>
                </form>
                
                
           <?php }?>

        </div>
    </div>


<?php  
?>
    
<?php include 'footer.php'?>