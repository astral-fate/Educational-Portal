<?php
session_start();
include_once('includes/conn.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $cat_name = $_POST['cat_name'];

        try {
            if ($cat_name) {
                $sql = "UPDATE `category` SET `cat_name` = ? WHERE `id` = ?";
                $stmtUpdate = $conn->prepare($sql);
                $stmtUpdate->execute([$cat_name, $id]);
                $msg = "Updated successfully";
                $alertType = "alert-success";
            }
        } catch (PDOException $e) {
            $msg = $e->getMessage();
            $alertType = "alert-danger";
        }
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $sql = "SELECT * FROM `category` WHERE `id` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        if ($result) {
            $cat_name = $result['cat_name'];
        } else {
            $msg = "Category not found";
            $alertType = "alert-danger";
        }
    } catch (PDOException $e) {
        $msg = $e->getMessage();
        $alertType = "alert-danger";
    }
} else {
    $msg = "No Category provided";
    $alertType = "alert-danger";
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/head.php');?>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="index.php" class="site_title"><i class="fa fa-graduation-cap"></i> <span>Education Admin</span></a>
                </div>
                <div class="clearfix"></div>
                    
                <!-- menu profile quick info -->

                <?php include_once('includes/profile.php');?>

             
                <!-- sidebar menu -->

                <?php include_once('includes/sideBar.php');?>


            </div>
        </div>

        <?php include_once('includes/TopNav.php');?>

        <!-- CATEGORY FORM --> 
        <?php include_once('includes/CatForm.php');?>
        <!-- / CATEGORY FORM -->

        <!-- footer content -->
        <?php include_once('includes/menuFooter.php');?>
        <!-- /footer content -->
    </div>
</div>
<?php include_once('includes/AddMeetingScript.php');?>
</body>
</html>