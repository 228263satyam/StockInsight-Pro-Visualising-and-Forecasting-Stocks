<?php
// Start session
session_start();

include 'connect.php'; // Assuming you have a file connect.php to connect to MySQL

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form inputs
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verify password
    if ($user && $user['password'] === $password) {
        // Successful login
        $_SESSION['username'] = $username;
        header('Location: home.php'); // Redirect to profile/home page
        exit();
    } else {
        // Failed login
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - StockInsight Pro</title>
    <link rel="stylesheet" href="log_reg.css">
</head>
<body>
    <div class="form-container">
        <h2>Login to StockInsight Pro</h2>

        <!-- Display error message if login failed -->
        <?php if (isset($error_message)): ?>
            <p style="color:red;"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form id="loginForm" action="log_in.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
            <p class="switch-page">Don't have an account? <a href="register.php">Register here</a></p>
        </form>
    </div>
    <script src="log_reg.js"></script>
</body>
</html>
