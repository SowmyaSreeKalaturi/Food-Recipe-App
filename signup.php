<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    // Insert into signup table
    $sql = "INSERT INTO signup (username, email, password) VALUES ('$username', '$email', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Signup successful! Please login.'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
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
    <title>Signup</title>
</head>
<body>
    <div class="container">
        <form method="POST" action="">
            <h2>Signup</h2>
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Signup</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
