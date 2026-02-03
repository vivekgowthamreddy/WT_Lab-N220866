<?php
include "dbtest.php";

session_start();

// Function to clean input
function clean_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = clean_input($_POST["username"]);
    $password = clean_input($_POST["password"]);

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM students WHERE name = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Database error: " . $conn->error);
    }
    
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        
        // Handle case sensitivity - Compare strings properly
        // MySQL search might be case-insensitive, so we verify strictly in PHP
        if (strcmp($username, $user['name']) !== 0) {
            echo "Login failed.<br>";
            print "Username case mismtch.";
            die();
        }

        // Verify password with hashing
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['name'];
            header("Location: Lab2/home.php");
            exit();
        } else {
            echo "Login failed.<br>";
            print "Invalid password.";
            die();
        }
    } else {
        echo "Login failed.<br>";
        print "Invalid username.";
        die();
    }
    $stmt->close();
} else {
    // If someone tries to access login.php directly without POST
    header("Location: Lab2/login.html");
    exit();
}
?>

