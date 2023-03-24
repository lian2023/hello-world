<?php

// Set database information
$host = "localhost";
$username = "username";
$password = "password";
$dbname = "school_db";

// Connect to the database
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process user login request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username and password entered by the user
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if the user exists in the database
    $sql = "SELECT * FROM students WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login successful, redirect to user home page
        header("Location: user_home.php");
    } else {
        // Login failed, return error message
        $error_message = "Invalid username or password. Please try again.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login - School</title>
</head>
<body>
    <h2>Student Login</h2>
    <?php if (isset($error_message)) { ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Username:</label>
        <input type="text" name="username"><br><br>
        <label>Password:</label>
        <input type="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
