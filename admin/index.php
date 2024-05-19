<?php 
    include 'header.php';
    include 'helpers.php';
    
?>
    <div class="dashboard">
        <div class="container">
            <div class="boxes row w-100 gap-3">
                <div class="box col text-center">
                    <div class="mx-auto p-4 w-100">
                        <h3><?php getCount('projects', $con);?></h3>
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <p class="fs-2 m-0">المشاريع</p>
                </div>
                <div class="box col text-center">
                    <div class="mx-auto p-4 w-100">
                        <h3><?php getCount('users', $con);?></h3>
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <p class="fs-2 m-0">المستخدمين</p>
                </div>
                <div class="box col text-center">
                    <div class="mx-auto p-4 w-100">
                        <h3>10</h3>
                        <i class="fa-solid fa-comments"></i>
                    </div>
                    <p class="fs-2 m-0">المنشورات</p>
                </div>
            </div>
        </div>
    </div>
<?php include 'footer.php'?>