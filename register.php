<?php
// Include the database connection file (update with your connection settings)
include 'connect.php';

// Initialize variables to store error messages and success flag
$name = $username = $email = $phone = $password = "";
$nameErr = $usernameErr = $emailErr = $phoneErr = $passwordErr = "";
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input values and sanitize them
    $name = trim($_POST["name"]);
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $password = trim($_POST["password"]);
    $confirmPassword = trim($_POST["confirmPassword"]);

    // Server-side validation
    if (empty($name)) {
        $nameErr = "Name is required";
    }
    
    if (empty($username)) {
        $usernameErr = "Username is required";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }

    if (!preg_match("/^[0-9]{10}$/", $phone)) {
        $phoneErr = "Please enter a valid 10-digit phone number";
    }

    if ($password !== $confirmPassword) {
        $passwordErr = "Passwords do not match";
    }

    if (empty($passwordErr) && empty($nameErr) && empty($usernameErr) && empty($emailErr) && empty($phoneErr)) {
        // Hash the password using bcrypt (PASSWORD_DEFAULT uses bcrypt)
      //  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute the SQL query to insert user data into the database
        $sql = "INSERT INTO users (name, username, email, phone, password) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssss", $name, $username, $email, $phone, $password);

            if ($stmt->execute()) {
                $success = true;
                header("Location:log_in.php?register=success"); // Redirect to login page after successful registration
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $stmt->close();
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - StockInsight Pro</title>
    <link rel="stylesheet" href="log_reg.css">
</head>

<body>
    <div class="form-container">
        <h2>Register for StockInsight Pro</h2>
        <form id="registerForm" action="register.php" method="POST">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                <span style="color:red;"><?php echo $nameErr; ?></span>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                <span style="color:red;"><?php echo $usernameErr; ?></span>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                <span style="color:red;"><?php echo $emailErr; ?></span>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required>
                <span style="color:red;"><?php echo $phoneErr; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
                <span style="color:red;"><?php echo $passwordErr; ?></span>
            </div>
            <button type="submit" class="btn">Register</button>
            <p class="switch-page">Already have an account? <a href="log_in.php">Login here</a></p>
        </form>
    </div>
</body>

</html>
