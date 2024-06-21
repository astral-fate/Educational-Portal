<?php
if (isset($_SESSION['msg']) && isset($_SESSION['alertType'])) {
    echo "<div class='alert " . $_SESSION['alertType'] . "'>" . $_SESSION['msg'] . "</div>";
    unset($_SESSION['msg']);
    unset($_SESSION['alertType']);
}
?>