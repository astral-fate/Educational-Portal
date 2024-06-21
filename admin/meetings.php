<?php
session_start();
include_once('includes/conn.php');
include_once('includes/deleteAlert.php');

if (isset($_SESSION['Email'])) {
    $email = $_SESSION['Email'];
    try {
        $sql = "SELECT `name` FROM `users` WHERE `Email` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch();
            $fullName = $user['name'];
        } else {
            $fullName = "User";
        }
    } catch(PDOException $e) {
        $msg = $e->getMessage();
        $alertType = "alert-danger";
    }
} else {
    $fullName = "Guest";
}


try{
  $sql = "SELECT * FROM courses";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
} catch(PDOException $e) {
  $msg = $e->getMessage();
  $alertType = "alert-danger";
}

?>


<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/head.php'); ?>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><i class="fa fa-graduation-cap"></i></i> <span>Education Admin</span></a>
            </div>

            <div class="clearfix"></div>


            <?php include_once('includes/profile.php'); ?>


            <!-- sidebar menu -->
					  <?php include_once('includes/sideBar.php'); ?>
					<!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <?php include_once('includes/menuFooter.php'); ?>
            <!-- /menu footer buttons -->
          </div>

        </div>

        <!-- top navigation -->
        <?php include_once('includes/TopNav.php'); ?>

        <!-- /top navigation -->

        <!-- page content -->
        <?php include_once('includes/meetingContent.php'); ?>
        <!-- /page content -->

        <!-- footer content -->
        <?php include_once('includes/footerAddMeeting.php'); ?>

        <!-- /footer content -->
      </div>
    </div>


    <?php include_once('includes/AddMeetingScript.php'); ?>


  </body>
</html>