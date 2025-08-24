<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: log_in.php"); // Redirect to login page if not logged in
    exit();
}

// Include the database connection file
include('connect.php');

// Fetch user data from the database based on the session's username
$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

// Fetch user data
$user = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="user_dashboard.css">
</head>

<body>
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h1>
        <nav>
            <ul class="nav-menu">
                <li><a href="home.php">Home</a></li>
                <!-- Add the logout button inside a form -->
                <li class="logout-item">
                    <form method="post" action="logout.php" onsubmit="return confirmLogout();">
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="user-info">
            <h2>Your Account Details</h2>
            <table>
                <tr>
                    <th>Name:</th>
                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                </tr>
                <tr>
                    <th>Username:</th>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                </tr>
                <tr>
                    <th>Phone:</th>
                    <td><?php echo htmlspecialchars($user['phone']); ?></td>
                </tr>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 StockInsight Pro. All Rights Reserved.</p>
    </footer>

    <script>
        function confirmLogout() {
            return confirm("Are you sure you want to log out?");
        }
    </script>
</body>

</html>

