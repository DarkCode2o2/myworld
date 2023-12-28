<?php 
    session_start();
    include "../connect.php";

    if(!isset($_SESSION['admin_name'])) {
        header('Location: login.php');
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $show = $_POST['show_pro'];


        $avatar_name = $_FILES['avatar']['name'];
        $avatar_type = $_FILES['avatar']['type'];
        $avatar_tmp = $_FILES['avatar']['tmp_name'];
        $avatar_name_withoutSpace = str_replace(' ', '_', $avatar_name);
        $allowedType = array('png', 'jpg', 'jpeg', 'webp', 'gif');
        $avatarEx = explode('/', $avatar_type)[1];

        if(!in_array($avatarEx, $allowedType)) {

            $avatar_error = "<p class='alert alert-danger msg'>خطأ في النوع الصورة!</p>";             
        }

        $letters = str_split('abcdefghijklmnopqrstuvwxyz');
        $randomLetters = '';

        for($i = 0; $i < 20; $i++) {
            $randomLetters .= $letters[rand(1, 20)];
        }

        $avatar = $randomLetters . '_'. $avatar_name_withoutSpace;

        if(empty($avatar_error)) {
            
            $sql = $con->prepare("INSERT INTO projects (title, content, show_pro, image, created_at) VALUES (?, ?, ?, ?, now())");
            $sql->execute(array($title, $content, $show, $avatar));

            move_uploaded_file($avatar_tmp, '../uploads/projects_image/'. $avatar);

            $success = "<p class='alert alert-success msg'>تم الإضافة بنجاح</p>";
        }
        
    }

?>

<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
    <h3>إضافة مشاريع</h3>
        <div class="row">
            <label class="col-2 form-label">العنوان</label>
            <div class="col-10">
                <input type="text" name="title" class="form-control" required>
            </div>
            <label class="col-2 form-label">المحتوى</label>
            <div class="col-10">
                <input type="text" name="content" class="form-control" required>
            </div>

            <label class="col-2 form-label">رابط العرض</label>
            <div class="col-10">
                <input type="text" name="show_pro" class="form-control">
            </div>

            <label class="col-2 form-label">الصورة</label>
            <div class="col-10">
                <input type="file" name="avatar" class="form-control" required>
            </div>
            <?php echo $avatar_error ?? null?>
            <?php echo $success ?? null?>
        </div>
        <input type="submit" value="إرسال" class="btn btn-primary w-50">
    </form>
    <script>
        let message = document.querySelectorAll('.msg');
        
        message.forEach((element) => 
           setTimeout(() => {
                element.style.display = 'none';
           }, 3000)
        )
    </script>
</body>
</html>