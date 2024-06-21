<?php

include_once('includes/conn.php');
include_once('includes/deleteAlert.php');

$fullName = "Guest";
if (isset($_SESSION['Email'])) {
    $email = $_SESSION['Email'];
    try {
        $sql = "SELECT `name` FROM `users` WHERE `Email` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $fullName = $user['name'];
        } else {
            $fullName = "User";
        }
    } catch (PDOException $e) {
        $msg = $e->getMessage();
        $alertType = "alert-danger";
    }
} 

try {
    $sql = "SELECT * FROM courses";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
} catch (PDOException $e) {
    $msg = $e->getMessage();
    $alertType = "alert-danger";
}
?>

<!-- Profile HTML -->
<div class="profile clearfix">
    <div class="profile_pic">
        <img src="images/img.jpg" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
        <span>Welcome,</span>
        <h2><?php echo htmlspecialchars($fullName); ?></h2>
    </div>
</div>
<!-- /menu profile quick info -->
