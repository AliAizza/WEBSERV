<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file = $_FILES['file'];
    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];

    // Check for errors
    if ($file_error === 0) {
        // Check file size
        if ($file_size < 1000000) {
            // Generate a unique name for the file to be uploaded
            $file_new_name = uniqid('', true) . '.' . strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $file_destination = 'uploads/' . $file_new_name;

            // Upload the file to the server
            move_uploaded_file($file_tmp_name, $file_destination);

            // Return HTML response
            echo '<html><body>';
            echo '<h1>File uploaded successfully!</h1>';
            echo '<p>File Name: ' . $file_name . '</p>';
            echo '<p>File Size: ' . $file_size . ' bytes</p>';
            echo '</body></html>';
        } else {
            echo 'File size is too large. Please upload a file smaller than 1 MB.';
        }
    } else {
        echo 'Error uploading file. Please try again.';
    }
} else {
    // Return HTML form
    echo '<html><body>';
    echo '<h1>Upload a File</h1>';
    echo '<form method="post" enctype="multipart/form-data">';
    echo '<input type="file" name="file" />';
    echo '<br><br>';
    echo '<input type="submit" value="Upload" />';
    echo '</form>';
    echo '</body></html>';
}

?>