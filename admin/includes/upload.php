<?php
// Get reference to uploaded image
$image_file = $_FILES["Image"]; 

// Exit if no file uploaded
if (!isset($image_file)) {
    die('No file uploaded.');
}

// Exit if image file is zero bytes
if (filesize($image_file["tmp_name"]) <= 0) {
    die('Uploaded file has no contents.');
}

// Exit if is not a valid image file
$image_type = exif_imagetype($image_file["tmp_name"]);
if (!$image_type) {
    die('Uploaded file is not an image.');
}

// Get file extension based on file type, to prepend a dot we pass true as the second parameter
$image_extension = image_type_to_extension($image_type, true);

// Create a unique image name
$image_name = bin2hex(random_bytes(16)) . $image_extension;

// Define the target directory
$target_dir = __DIR__ . "images/";

// Ensure the target directory exists
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Move the temp image file to the images directory
if (!move_uploaded_file(
    // Temp image location
    $image_file["tmp_name"],

    // New image location
    $target_dir . $image_name
)) {
    die('Failed to move uploaded file.');
}

?>
