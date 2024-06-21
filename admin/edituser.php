<?php
session_start();
include_once('includes/conn.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['Email'];
        $username = $_POST['username'];
        $active = isset($_POST['active']) ? 1 : 0;
        $password = !empty($_POST['Password']) ? password_hash($_POST['Password'], PASSWORD_DEFAULT) : null;

        try {
            if ($password) {
                $sql = "UPDATE `users` SET `name`=?, `Email`=?, `username`=?, `Password`=?, `active`=? WHERE `id`=?";
                $stmtUpdate = $conn->prepare($sql);
                $stmtUpdate->execute([$name, $email, $username, $password, $active, $id]);
            } else {
                $sql = "UPDATE `users` SET `name`=?, `Email`=?, `username`=?, `active`=? WHERE `id`=?";
                $stmtUpdate = $conn->prepare($sql);
                $stmtUpdate->execute([$name, $email, $username, $active, $id]);
            }
            $msg = "Updated successfully";
            $alertType = "alert-success";
        } catch (PDOException $e) {
            $msg = $e->getMessage();
            $alertType = "alert-danger";
        }
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $sql = "SELECT * FROM `users` WHERE `id` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        if ($result) {
            $name = $result['name'];
            $email = $result['Email'];
            $username = $result['username'];
            $active = $result['Active'];
        } else {
            $msg = "User not found";
            $alertType = "alert-danger";
        }
    } catch (PDOException $e) {
        $msg = $e->getMessage();
        $alertType = "alert-danger";
    }
} else {
    $msg = "No user ID provided";
    $alertType = "alert-danger";
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/head.php'); ?>

<body class="nav-md">
<?php
		
			include_once('includes/alert.php');
			if(isset($id)){
		?>
	
	
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<a href="index.php" class="site_title"><i class="fa fa-graduation-cap"></i> <span>Education Admin</span></a>
					</div>

					<div class="clearfix"></div>

					<div class="clearfix"></div>
                    
					<!-- menu profile quick info -->
	
					<?php include_once('includes/profile.php');?>

					
                    <!-- /menu footer buttons -->
                    <?php include_once('includes/menuFooter.php'); ?>
                    <!-- /menu footer buttons -->
	
				 
					<!-- sidebar menu -->
	
					<?php include_once('includes/sideBar.php');?>
	
	
				</div>
			</div>
	
			<?php include_once('includes/TopNav.php');?>
	


			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Manage Users</h3>
						</div>

						<div class="title_right">
							<div class="col-md-5 col-sm-5  form-group pull-right top_search">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search for...">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button">Go!</button>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Edit User</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
											<ul class="dropdown-menu" role="menu">
												<li><a class="dropdown-item" href="#">Settings 1</a>
												</li>
												<li><a class="dropdown-item" href="#">Settings 2</a>
												</li>
											</ul>
										</li>
										<li><a class="close-link"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<!-- FORM  -->
									<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Full Name <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text" id="name" name="name" required="required" class="form-control" value="<?php echo htmlspecialchars($name); ?>">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="username">Username <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text" id="username" name="username" required="required" class="form-control" value="<?php echo htmlspecialchars($username); ?>">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label for="email" class="col-form-label col-md-3 col-sm-3 label-align">Email <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input id="email" class="form-control" type="email" name="Email" value="<?php echo htmlspecialchars($email); ?>" required="required">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">active</label>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" class="flat" name="active" id="active" <?php echo $active ? 'checked' : ''; ?>>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="password">Password</label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="password" id="Password" name="Password" class="form-control">
                                            <small>Leave blank if you do not want to change the password</small>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="item form-group">
                                        <div class="col-md-6 col-sm-6 offset-md-3">
                                            <button class="btn btn-primary" type="button">Cancel</button>
                                            <button type="submit" name="update" class="btn btn-success">Update</button>
                                        </div>
                                    </div>
                                </form>


								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<!-- /page content -->

			<!-- footer content -->
			<?php include_once('includes/menuFooter.php');?>
			<!-- /footer content -->

			
		</div>
	</div>
	<?php include_once('includes/AddMeetingScript.php');?>
	
	<?php
			}
		?>
</body>
</html>