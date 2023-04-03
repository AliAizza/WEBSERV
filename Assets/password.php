<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the email and password fields are present
    if (!isset($_POST['email']) || !isset($_POST['password'])) {
        die("Email and password fields are required");
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    // You can do further processing with the email and password fields here
    // ...

    // Respond with a success message
    echo "Email and password received successfully";
} else {
    // Respond with a simple HTML form for testing
    echo '<form method="post" action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '">
        <label>Email:</label><br>
        <input type="text" name="email"><br>
        <label>Password:</label><br>
        <input type="password" name="password"><br>
        <input type="submit" value="Submit">
    </form>';
}
?>