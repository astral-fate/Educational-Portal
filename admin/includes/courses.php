<?php
try {
   $sql = "SELECT * FROM courses WHERE click_count = (SELECT MAX(click_count) FROM courses)";
   $stmt = $conn->prepare($sql);
    $stmt->execute();
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $msg = $e->getMessage();
    $alertType = "alert-danger";
}
?>

<html>



<section class="our-courses" id="courses">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h2>Our Popular Courses</h2>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="owl-courses-item owl-carousel">
          <?php
            foreach ($courses as $row) {
                $id = htmlspecialchars($row['id']);
                $Title = htmlspecialchars($row['Title']);
                $Content = htmlspecialchars($row['Content']);
                $Location = htmlspecialchars($row['Location']);
                $Price = htmlspecialchars($row['Price']);
                $Image = htmlspecialchars($row['Image']);
                $Date = htmlspecialchars($row['Date']);
            ?>        
          
          <div class="item">
              <img src="assets/images/course-01.jpg" alt="Course One">
              <div class="down-content">
                <h4><?php echo $Title; ?></h4>
                <div class="info">
                  <div class="row">

                    <div class="col-8">
                      <ul>
                        <li><i class="fa fa-star"></i></li>

                      </ul>
                    </div>
                    <div class="col-4">
                       <span><?php echo $Price; ?>$</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
               <!-- end of course -->

               <?php
                                }
                                ?>
            <!-- end of tags -->
          </div>
        </div>
      </div>
      
    </div>
  </section>
</html>
