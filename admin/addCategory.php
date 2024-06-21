<?php

session_start();
include_once('includes/conn.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cat_name = $_POST['cat_name'];

    try {
        $sql = "INSERT INTO `category`(`cat_name`) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$cat_name]);
        $msg = "Inserted Successfully";
        $alertType = "alert-success";
    } catch (PDOException $e) {
        $msg = $e->getMessage();
        $alertType = "alert-danger";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/head.php'); 

include_once('includes/alert.php');

?>
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
					<?php include_once('includes/profile.php'); ?>

					<!-- menu side bar -->
					<?php include_once('includes/sideBar.php'); ?>


					<!-- menu bar  -->
					<?php include_once('includes/menuBar.php'); ?>

				</div>

			</div>


			<!-- top navigation -->
			<?php include_once('includes/TopNav.php'); ?>


			<!-- page content -->		
			<?php include_once('includes/pageContentCat.php'); ?>

			
			<!--  footer -->	
	        <?php include_once('includes/footerAddMeeting.php'); ?>
	
		</div>
	</div>

	<?php include_once('includes/AddMeetingScript.php'); ?>

</body></html>