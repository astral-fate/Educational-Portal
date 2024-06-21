<?php
    if(isset($msg)){
?>
    <div class="alert <?php echo $alertType ?>">
        <?php echo $msg ?>
    </div>
<?php
    }
?>