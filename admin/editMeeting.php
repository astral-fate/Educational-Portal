<?php
session_start();
include_once('includes/conn.php');

// Fetch meeting details if `id` is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $sql = "SELECT courses.*, category.cat_name FROM courses 
                JOIN category ON courses.Category_id = category.id 
                WHERE courses.id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();

        if ($result) {
            $Title = $result['Title'];
            $Content = $result['Content'];
            $Location = $result['Location'];
            $Price = $result['Price'];
            $Date = $result['Date'];
            $Category = $result['Category_id'];
            $active = $result['Active'];
            $image_name = $result['Image'];
            $cat_name = $result['cat_name'];
        } else {
            $msg = "Meeting not found";
            $alertType = "alert-danger";
        }
    } catch (PDOException $e) {
        $msg = $e->getMessage();
        $alertType = "alert-danger";
    }
} else {
    $msg = "No meeting ID provided";
    $alertType = "alert-danger";
}

// Update meeting details if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $Title = $_POST['Title'] ?? '';
    $Content = $_POST['Content'] ?? '';
    $Location = $_POST['Location'] ?? '';
    $Price = $_POST['Price'] ?? '';
    $Date = $_POST['Date'] ?? '';
    $Category = $_POST['Category'] ?? '';
    $active = isset($_POST['active']) ? 1 : 0;
    $image_name = $_FILES['Image']['name'] ?? $image_name;

    if (!empty($_FILES['Image']['tmp_name'])) {
        move_uploaded_file($_FILES['Image']['tmp_name'], "images/" . $image_name);
    }

    try {
        $sql = "UPDATE courses SET Title = ?, Content = ?, Location = ?, Price = ?, Date = ?, Category_id = ?, Active = ?, Image = ? WHERE id = ?";
        $stmtUpdate = $conn->prepare($sql);
        $stmtUpdate->execute([$Title, $Content, $Location, $Price, $Date, $Category, $active, $image_name, $id]);

        $msg = "Updated successfully";
        $alertType = "alert-success";
    } catch (PDOException $e) {
        $msg = $e->getMessage();
        $alertType = "alert-danger";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/head.php'); ?>
<body class="nav-md">
<?php
include_once('includes/alert.php');
if (isset($id)) {
?>   
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="index.php" class="site_title"><i class="fa fa-graduation-cap"></i> <span>Education Admin</span></a>
                </div>
                <div class="clearfix"></div>

                <?php include_once('includes/profile.php'); ?>
                <?php include_once('includes/sideBar.php'); ?>

                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.php">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
        </div>

        <?php include_once('includes/TopNav.php'); ?>

        <div class="right_col" role="main">
            <div class="">
            <?php include_once('includes/pageTitle.php'); ?>
            <?php include_once('includes/EditMeetingForm.php'); ?>
            </div>
        </div>

        <?php include_once('includes/footerAddMeeting.php'); ?>
    </div>
</div>

<?php include_once('includes/AddMeetingScript.php'); ?>

<?php
}
?>
</body>
</html>
