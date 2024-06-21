<?php
session_start();
include_once('includes/conn.php');

$active = 0;

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['Date'];
    $title = $_POST['Title'];
    $content = $_POST['Content'];
    $location = $_POST['Location'];
    $price = $_POST['Price'];
    $category = $_POST['Category'];
    $active = isset($_POST['active']) ? 1 : 0;

    // Handle image upload
    $image = $_FILES['Image']['name'];
    $target = "images/" . basename($image);

    // Insert data into the database
    try {
        $sql = "INSERT INTO courses (date, title, content, location, price, category_id, active, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$date, $title, $content, $location, $price, $category, $active, $image]);

        // Move the uploaded image to the target directory
        if (move_uploaded_file($_FILES['Image']['tmp_name'], $target)) {
            $msg = "Meeting added successfully";
            $alertType = "alert-success";
        } else {
            $msg = "Failed to upload image";
            $alertType = "alert-danger";
        }
    } catch (PDOException $e) {
        $msg = $e->getMessage();
        $alertType = "alert-danger";
    }
}

// Fetch categories
try {
    $sql = "SELECT * FROM category";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
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
                        <a href="index.php" class="site_title"><i class="fa fa-graduation-cap"></i> <span>Education Admin</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <?php include_once('includes/profile.php'); ?>
                    <!-- /menu profile quick info -->

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
            
            <?php include_once('includes/AddMeetingContent.php'); ?>
            <!-- /page content -->

            <!-- footer content -->
            <?php include_once('includes/menuFooter.php'); ?>
            <!-- /footer content -->
        </div>
    </div>

    <?php include_once('includes/AddMeetingScript.php'); ?>

</body>
</html>
