<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Process form data
    $name = $_POST["name"] ?? "";
    $email = $_POST["email"] ?? "";
    $avatar = $_FILES["avatar"] ?? null;
    
    // Check if form data is valid
    if (empty($name) || empty($email) || $avatar === null || $avatar["error"] !== UPLOAD_ERR_OK) {
        http_response_code(400);
        echo "<h1>Invalid form data</h1>";
        exit;
    }
    
    // Save uploaded file
    $filename = "uploads/" . basename($avatar["name"]);
    if (!move_uploaded_file($avatar["tmp_name"], $filename)) {
        http_response_code(500);
        echo "<h1>Failed to save uploaded file</h1>";
        exit;
    }
    
    // Send response
    echo "<h1>Thank you for your submission, $name!</h1>";
    echo "<p>Your email address is $email.</p>";
    echo "<p>Your avatar has been uploaded to $filename.</p>";
} else {
    // Display form
    echo <<<HTML
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Example Form</title>
  </head>
  <body>
    <form method="POST" action="{$_SERVER["PHP_SELF"]}" enctype="multipart/form-data">
      <label for="name">Name:</label>
      <input type="text" name="name" id="name"><br><br>
      <label for="email">Email:</label>
      <input type="email" name="email" id="email"><br><br>
      <label for="avatar">Avatar:</label>
      <input type="file" name="avatar" id="avatar"><br><br>
      <input type="submit" value="Submit">
    </form>
  </body>
</html>
HTML;
}
?>