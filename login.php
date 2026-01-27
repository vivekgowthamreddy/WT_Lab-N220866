<?php
include "dbtest.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM students WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        // Verify password with hashing
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['name'];
            header("Location: Lab2/home.php");
            exit();
        } else {
            $error = "Invalid username or password";
            header("Location: Lab2/login.html?error=" . urlencode($error));
            exit();
        }
    } else {
        $error = "Invalid username or password";
        header("Location: Lab2/login.html?error=" . urlencode($error));
        exit();
    }
    $stmt->close();
} else {
    // If someone tries to access login.php directly without POST, redirect to login.html
    header("Location: Lab2/login.html");
    exit();
}
?>

