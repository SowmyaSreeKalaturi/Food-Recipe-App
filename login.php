<?php
// Include database connection file
include 'db.php';

session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the user exists in the signup table
    $query = "SELECT * FROM signup WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Fetch user data
        $user = $result->fetch_assoc();
        // Verify password (assuming you hashed passwords during signup)
        if (password_verify($password, $user['password'])) {
            // Insert login details into the login table
            $insertQuery = "INSERT INTO login (email) VALUES (?)";
            $insertStmt = $conn->prepare($insertQuery);
            $insertStmt->bind_param("s", $email);
            $insertStmt->execute();

            // Show success message
            echo "<script>alert('Login successful'); window.location.href='index2.php';</script>";            
            // Redirect or perform other actions
        } else {
            // Show error message
            echo "<script>alert('Login unsuccessful: Incorrect password');</script>";
        }
    } else {
        // Show error message
        echo "<script>alert('Login unsuccessful: User not found');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style2.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <form method="POST" action="">
            <h2>Login</h2>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Signup here</a></p>
    </div>
</body>
</html>
