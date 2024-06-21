<?php
session_start();

include_once("admin/includes/conn.php");


// Get the course ID from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

try {
    // Update click count
    $sql = "UPDATE courses SET click_count = click_count + 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    // Fetch course details
    $sql = "SELECT * FROM courses WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $course = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$course) {
        throw new Exception("Course not found");
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">

<?php include_once("admin/includes/indexHead.php"); ?>

<body>

<?php include_once("admin/includes/subHeaderIndex.php"); ?>


<?php include_once("admin/includes/HeadIndex.php"); ?>


    <section class="meetings-page" id="meetings">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="meeting-single-item">
                                <div class="thumb">
                                    <div class="price">
                                        <span><?php echo htmlspecialchars($course['Price']); ?>$</span>
                                    </div>
                                    <div class="date">
                                        <h6><?php echo date('F', strtotime($course['Date'])); ?> <span><?php echo date('d', strtotime($course['Date'])); ?></span></h6>
                                    </div>
                                    
                                    <img src="admin/images/<?php echo htmlspecialchars($course['Image']); ?>" alt="Course Image">
                            
                                </div>
                                <div class="down-content">
                                    <a href="meeting-details.php"><h4><?php echo htmlspecialchars($course['Title']); ?></h4></a>
                                    <p><?php echo htmlspecialchars($course['Content']); ?></p>
                                    <p><strong>Views:</strong> <?php echo $course['click_count']; ?></p>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="hours">
                                                <h5>Hours</h5>
                                                <p>Monday - Friday: 07:00 AM - 13:00 PM<br>Saturday- Sunday: 09:00 AM - 15:00 PM</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="location">
                                                <h5>Location</h5>
                                                <p><?php echo htmlspecialchars($course['Location']); ?></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="book-now">
                                                <h5>Book Now</h5>
                                                <p>010-020-0340<br>090-080-0760</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="share">
                                                <h5>Share:</h5>
                                                <ul>
                                                    <li><a href="#">Facebook</a>,</li>
                                                    <li><a href="#">Twitter</a>,</li>
                                                    <li><a href="#">Linkedin</a>,</li>
                                                    <li><a href="#">Behance</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="main-button-red">
                                <a href="meetings.php">Back To Meetings List</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>