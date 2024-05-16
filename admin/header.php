<?php 

session_start();
include "../connect.php";

if(!isset($_SESSION['admin_name'])) {
    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css?time=<?php echo time()?>">
    <link rel="stylesheet" href="../css/all.min.css">
</head>
<body>
    <header class="d-flex justify-content-between align-items-center px-4 py-2 bg-primary text-light shadow-sm">
        <ul class="navbar m-0">
            <li><a href="index.php" class="text-light fs-4 mx-4 active">لوحة التحكم</a></li>
            <li><a href="projects.php" class="text-light fs-4 mx-4">المشاريع</a></li>
            <li><a href="posts.php" class="text-light fs-4 mx-4">المنشورات</a></li>
            <li><a href="reviews.php" class="text-light fs-4 mx-4">آراء العملاء</a></li>
            <li><a href="logout.php" class="text-light fs-4 mx-4"> تسجيل الخروج </a></li>
        </ul>
        <h3 class="logo">Dark Code</h3>
    </header>