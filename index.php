<?php
session_start();

include_once("admin/includes/conn.php");

// Fetch data from category table
try {
    $sql = "SELECT * FROM category";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $cats = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $msg = $e->getMessage();
    $alertType = "alert-danger";
}

// Initialize courses array
$courses = [];
$current_date = date('Y-m-d');

// Check if a category ID is set in the URL
if (isset($_GET['category_id'])) {
    $category_id = intval($_GET['category_id']);
    // Fetch data from courses table based on category ID
    try {
        $sql = "SELECT courses.*, category.cat_name FROM courses
                JOIN category ON courses.category_id = category.id
                WHERE category.id = :category_id AND courses.active = 1 AND courses.date >= :current_date";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindParam(':current_date', $current_date, PDO::PARAM_STR);
        $stmt->execute();
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $msg = $e->getMessage();
        $alertType = "alert-danger";
    }
} else {
    // Fetch all active courses with date greater than or equal to today
    try {
        $sql = "SELECT courses.*, category.cat_name FROM courses
                JOIN category ON courses.category_id = category.id
                WHERE courses.active = 1 AND courses.date >= :current_date";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':current_date', $current_date, PDO::PARAM_STR);
        $stmt->execute();
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $msg = $e->getMessage();
        $alertType = "alert-danger";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include_once("admin/includes/indexHead.php"); ?>

<body>

<?php include_once("admin/includes/subHeaderIndex.php"); ?>

<?php include_once("admin/includes/HeadIndex.php"); ?>


<?php include_once("admin/includes/bannerIndex.php"); ?>


<?php include_once("admin/includes/servises.php"); ?>


    <!-- Fetching Meetings -->

    <section class="upcoming-meetings" id="meetings">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Upcoming Meetings</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="categories">
                        <h4>Meeting Categories</h4>
                        <ul>
                            <?php
                            foreach ($cats as $row) {
                                $id = htmlspecialchars($row['id']);
                                $cat_name = htmlspecialchars($row['cat_name']);
                                echo "<li><a href='index.php?category_id=$id'>$cat_name</a></li>";
                            }
                            ?>
                        </ul>
                        <div class="main-button-red">
                            <a href="meetings.php">All Upcoming Meetings</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="row" id="courses-container">
                        <?php
                        foreach ($courses as $row) {
                            $id = htmlspecialchars($row['id']);
                            $Title = htmlspecialchars($row['Title']);
                            $Content = htmlspecialchars($row['Content']);
                            $Location = htmlspecialchars($row['Location']);
                            $Price = htmlspecialchars($row['Price']);
                            $Image = htmlspecialchars($row['Image']);
                            $Category = htmlspecialchars($row['cat_name']);
                            $Date = htmlspecialchars($row['Date']);
                        ?>
                        <div class="col-lg-6 course-item" data-category-id="<?php echo $row['category_id']; ?>">
                            <div class="meeting-item">
                                <div class="thumb">
                                    <div class="price">
                                        <span><?php echo $Price; ?>$</span>
                                    </div>
                                    <a href="meeting-details.php?id=<?php echo $id ?>"><img src="admin/images/<?php echo $Image; ?>" alt="<?php echo $Title; ?>"></a>
                                </div>
                                <div class="down-content">
                                    <div class="date">
                                        <h6><?php echo date('F', strtotime($Date)); ?> <span><?php echo date('d', strtotime($Date)); ?></span></h6>
                                    </div>
                                    <a href="meeting-details.php?id=<?php echo $id ?>"><h4><?php echo $Title; ?></h4></a>
                                    <p><?php echo $Content; ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php include_once("admin/includes/apply.php"); ?>

    <?php include_once("admin/includes/courses.php"); ?>


    <?php include_once("admin/includes/fact.php"); ?>


    <?php include_once("admin/includes/contact.php"); ?>


    <?php include_once("admin/includes/indexScript.php"); ?>


</body>

</html>
