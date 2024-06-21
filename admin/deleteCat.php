<?php

session_start();
include_once('includes/conn.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Check if the category is used by any course
        $sqlCheck = "SELECT COUNT(*) FROM courses WHERE Category = ?";
        $stmtCheck = $conn->prepare($sqlCheck);
        $stmtCheck->execute([$id]);
        $count = $stmtCheck->fetchColumn();
        

        if ($count > 0) {
            // Category is used by some courses, cannot delete
            $_SESSION['msg'] = "Cannot delete category as it is used by one or more courses.";
            $_SESSION['alertType'] = "alert-danger";
        } else {
            // Category is not used, proceed with deletion
            $sqlDelete = "DELETE FROM category WHERE id = ?";
            $stmtDelete = $conn->prepare($sqlDelete);
            $stmtDelete->execute([$id]);

            $_SESSION['msg'] = "Category deleted successfully.";
            $_SESSION['alertType'] = "alert-success";
        }
    } catch (PDOException $e) {
        $_SESSION['msg'] = $e->getMessage();
        $_SESSION['alertType'] = "alert-danger";
    }
} else {
    $_SESSION['msg'] = "No category ID provided.";
    $_SESSION['alertType'] = "alert-danger";
}

header("Location: categories.php");
exit;

?>