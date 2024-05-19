<?php
    include 'header.php';
    include 'helpers.php';

    $sql = $con->prepare("SELECT * FROM projects ORDER BY project_id DESC");
    $sql->Execute();
    $projects = $sql->fetchAll();
?>

    <div class="projects">
        <div class="container p-0">
           <?php if(!isset($_GET['type'])) {?>
                <a href="?type=add" class="add-btn"> <i class="fa-solid fa-circle-plus"></i> أضافة مشروع</a>

                <h3 class="fs-1 text-primary mb-5 main-title">مشاريعي</h3>
                <div class="cards mb-5">
                    <?php foreach($projects as $project):?>
                        <div class="card rounded shadow-sm overflow-hidden">
                            <img src="../uploads/projects_image/<?php echo $project['image']?>" alt="...">
                            <div class="card-body h-auto">
                                <h5 class="card-title fs-2"><?php echo $project['title']?></h5>
                                <p class="card-text text-body-tertiary fw-bold"><?php echo $project['content']?></p>
                                <a href="?type=edit&id=<?php echo $project['project_id']?>" class="btn btn-primary">تعديل</a>
                                <a href="?type=delete&id=<?php echo $project['project_id']?>" class="btn btn-danger">حذف</a>
                                <a href="https://<?php echo $project['show_pro']?>" target="_blank" class="btn btn-info text-light">عرض</a>
                            </div>
                        </div>
                    <?php endforeach?>
                </div>
            <?php }else if (isset($_GET['type']) && $_GET['type'] == 'add' ) {

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
                <div class="add-pro w-100 d-flex justify-content-center align-items-center mt-5">
                    <form action="" method="POST" enctype="multipart/form-data" class="w-50">
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
                                <input type="text" name="show_pro" class="form-control" style="direction: ltr;" placeholder="اكتب الرابط دون https">
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
                </div>
            <?php }else if (isset($_GET['type']) && $_GET['type'] == 'edit') {
                    $id = $_GET['id'];
                    $data = getData($id, '*', 'projects', $con);

                    if($_SERVER['REQUEST_METHOD'] == 'POST') {

                        $title = $_POST['title'];
                        $content = $_POST['content'];
                        $show = $_POST['show_pro'];
                        $img = $_FILES['avatar'];
                
                        if($img['size'] > 0 ) {
                            $avatar_name = $img['name'];
                            $avatar_type = $img['type'];
                            $avatar_tmp = $img['tmp_name'];
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
                                $img = getData($id, 'image', 'projects', $con);
                                unlink('../uploads/projects_image/'. $img['image']);

                                $sql = $con->prepare("UPDATE projects SET title = ?,  content = ?, show_pro = ?, image = ? WHERE project_id = ?");
                                $sql->execute(array($title, $content, $show, $avatar, $id));
                    
                                move_uploaded_file($avatar_tmp, '../uploads/projects_image/'. $avatar);
                    
                                $success = "<p class='alert alert-success msg'>تم الإضافة بنجاح</p>";
                            }
                        }else {

                                $sql = $con->prepare("UPDATE projects SET title = ?,  content = ?, show_pro = ? WHERE project_id = ?");
                                $sql->execute(array($title, $content, $show, $id));
                                        
                                $success = "<p class='alert alert-success msg'>تم الإضافة بنجاح</p>";
                        }
                        
                    }

                ?>
                <div class="edit-pro w-100 d-flex justify-content-center align-items-center mt-5">
                    <form action="" method="POST" enctype="multipart/form-data" class="w-50">
                        <h3>إضافة مشاريع</h3>
                        <div class="row">
                            <label class="col-2 form-label">العنوان</label>
                            <div class="col-10">
                                <input type="text" name="title" class="form-control" required value="<?php echo isset($data['title']) ? $data['title'] : ''?>">
                            </div>
                            <label class="col-2 form-label">المحتوى</label>
                            <div class="col-10">
                                <input type="text" name="content" class="form-control" required value="<?php echo isset($data['content']) ? $data['content'] : ''?>">
                            </div>

                            <label class="col-2 form-label">رابط العرض</label>
                            <div class="col-10">
                                <input type="text" name="show_pro" class="form-control" style="direction: ltr;" placeholder="اكتب الرابط دون https" value="<?php echo isset($data['show_pro']) ? $data['show_pro'] : ''?>">
                            </div>

                            <label class="col-2 form-label">الصورة</label>
                            <div class="col-10">
                                <input type="file" name="avatar" class="form-control">
                            </div>
                            <?php echo $avatar_error ?? null?>
                            <?php echo $success ?? null?>
                        </div>
                        <input type="submit" value="إرسال" class="btn btn-primary w-50 fs-5">
                    </form>
                </div>
            <?php }else if (isset($_GET['type']) && $_GET['type'] == 'delete') {
                    $id = $_GET['id'];
                    $img = getData($id, 'image', 'projects', $con);

                    $delete = $con->prepare("DELETE FROM projects WHERE project_id = ?");
                    $delete->execute([$id]);

                    if($delete) {
                        unlink('../uploads/projects_image/'. $img['image']);

                        header("location: projects.php");
                    }

                ?>

            <?php }?>
        </div>
    </div>
<?php include 'footer.php'?>