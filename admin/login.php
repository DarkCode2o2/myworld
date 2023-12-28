<?php 
    session_start();

    if(isset($_SESSION['admin_name'])) {
        header("location: index.php");
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user = htmlspecialchars($_POST['admin_name']);
        $pass = htmlspecialchars($_POST['admin_pass']);

        if($user == "dark code" && $pass == "darkcode@gmail") {
            $_SESSION['admin_name'] = $user;

            header("Location: index.php");
            exit();
        }else {
            $error = '<p class="error msg">خطأ في اسم المستخدم او كلمة المرور!</p>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <form action="" method="POST"> 
        <h3>تسجيل دخول</h3>
        <div class="row">
            <div class="col-10">
                <input type="text" class="form-control" name="admin_name" placeholder="اسم المستخدم">
            </div>
            <div class="col-10">
                <input type="password" class="form-control" name="admin_pass" placeholder="كلمة المرور">
            </div>
            <?php echo $error ?? null?>
        </div>
        <input type="submit" value="تسجيل دخول" class="btn btn-primary">
    </form>
    <script src="../js/script.js"></script>
</body>
</html>