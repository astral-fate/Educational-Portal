<?php
include_once("admin/includes/conn.php");

// Define the number of courses per page
$coursesPerPage = 5;

// Get the current page and category ID from the URL
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;
$offset = ($page - 1) * $coursesPerPage;

// Get the current date
$current_date = date('Y-m-d');

// Fetch categories
try {
    $sql = "SELECT * FROM category";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $cats = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $msg = $e->getMessage();
    $alertType = "alert-danger";
}

// Fetch courses based on category ID and pagination
try {
    if ($category_id > 0) {
        $sql = "SELECT courses.*, category.cat_name FROM courses
                JOIN category ON courses.category_id = category.id
                WHERE category.id = :category_id AND courses.active = 1 AND courses.date >= :current_date
                LIMIT :limit OFFSET :offset";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    } else {
        $sql = "SELECT courses.*, category.cat_name FROM courses
                JOIN category ON courses.category_id = category.id
                WHERE courses.active = 1 AND courses.date >= :current_date
                LIMIT :limit OFFSET :offset";
        $stmt = $conn->prepare($sql);
    }
    $stmt->bindParam(':current_date', $current_date, PDO::PARAM_STR);
    $stmt->bindValue(':limit', $coursesPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $msg = $e->getMessage();
    $alertType = "alert-danger";
}

// Get the total number of active courses for pagination calculation
try {
    if ($category_id > 0) {
        $sql = "SELECT COUNT(*) FROM courses
                WHERE category_id = :category_id AND active = 1 AND date >= :current_date";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    } else {
        $sql = "SELECT COUNT(*) FROM courses WHERE active = 1 AND date >= :current_date";
        $stmt = $conn->prepare($sql);
    }
    $stmt->bindParam(':current_date', $current_date, PDO::PARAM_STR);
    $stmt->execute();
    $totalCourses = $stmt->fetchColumn();
    $totalPages = ceil($totalCourses / $coursesPerPage);
} catch (PDOException $e) {
    $msg = $e->getMessage();
    $alertType = "alert-danger";
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include_once("admin/includes/indexHead.php"); ?>

<body>
<?php include_once("admin/includes/meetingsHeaders.php"); ?>


    <section class="meetings-page" id="meetings">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="filters">
                                <ul>
                                       <?php
                                    foreach ($cats as $row) {
                                        $id = htmlspecialchars($row['id']);
                                        $cat_name = htmlspecialchars($row['cat_name']);
                                        echo "<li><a href='meetings.php?category_id=$id'>$cat_name</a></li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row grid">
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
                                <div class="col-lg-4 templatemo-item-col all soon">
                                    <div class="meeting-item">
                                        <div class="thumb">
                                            <div class="price">
                                                <span><?php echo $Price ?>$</span>
                                            </div>
                                            <a href="meeting-details.php?id=<?php echo $id ?>">
                                                <img src="admin/images/<?php echo $Image; ?>" 
                                            <a href="meeting-details.php?id= alt="<?php echo $Title; ?>"></a>
                                        </div>
                                        <div class="down-content">
                                            <div class="date">
                                                <h6><?php echo date('F', strtotime($Date)); ?> <span><?php echo date('d', strtotime($Date)); ?></span></h6>
                                            </div>
                                            <a href="meeting-details.php?id=<?php echo $id ?>"><h4><?php echo $Title; ?></h4></a>
                                            <p><?php echo $Content ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="pagination">
                                <ul>
                                    <?php
                                    for ($i = 1; $i <= $totalPages; $i++) {
                                        echo "<li><a href='meetings.php?page=$i";
                                        if ($category_id > 0) {
                                            echo "&category_id=$category_id";
                                        }
                                        echo "'>$i</a></li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once("admin/includes/footers.php"); ?>
    </section>

    <?php include_once("admin/includes/indexHead.php"); ?>

<body>

<?php include_once("admin/includes/indexScript.php"); ?>


</body>
</html>
