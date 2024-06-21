<?php
session_start();
include_once('includes/conn.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        // Category is not used, proceed with deletion
        $sqlDelete = "DELETE FROM courses WHERE id = ?";
        $stmtDelete = $conn->prepare($sqlDelete);
        $stmtDelete->execute([$id]);

        $_SESSION['msg'] = "Meeting deleted successfully.";
        $_SESSION['alertType'] = "alert-success";
    } catch (PDOException $e) {
        $_SESSION['msg'] = $e->getMessage();
        $_SESSION['alertType'] = "alert-danger";
    }
    // Redirect to the meetings list page
    header("Location: meetings.php");
    exit();
} else {
    $_SESSION['msg'] = "No meeting ID provided.";
    $_SESSION['alertType'] = "alert-danger";
    header("Location: meetings.php");
    exit();
}
?>