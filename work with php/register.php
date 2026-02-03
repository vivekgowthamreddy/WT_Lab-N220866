<?php
include "dbtest.php";

// Function to clean input
function clean_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Clean input using string functions
    $username = clean_input($_POST["username"]);
    $email = clean_input($_POST["email"]);
    $password = clean_input($_POST["password"]);

    // Validate input length
    if (strlen($username) < 3) {
        die("Error: Username must be at least 3 characters long.");
    }
    if (strlen($password) < 6) {
        die("Error: Password must be at least 6 characters long.");
    }

    // Format username properly (Capitalize first letter of each word)
    $username = ucwords(strtolower($username));

    // Hash the password before storing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Use prepared statement to prevent SQL injection
    $sql = "INSERT INTO students (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    // Check if prepare() failed
    if ($stmt === false) {
        die("Database error: " . $conn->error);
    }

    $stmt->bind_param("sss", $username, $email, $hashed_password);

    try {
        if ($stmt->execute()) {
            // Success
            $success = "Registration successful! Please login.";
            header("Location: Lab2/login.html?success=" . urlencode($success));
            exit();
        } else {
            die("Registration failed: " . $stmt->error);
        }
    } catch (Exception $e) {
        die("Registration failed. Username or email might already exist.");
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - SSMS</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: "Segoe UI", system-ui, sans-serif; }
    body { background: #f8f9fc; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 20px; }
    .container { width: 100%; max-width: 400px; }
    .form-box { background: white; padding: 40px 30px; border-radius: 12px; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05); }
    .form-title { text-align: center; margin-bottom: 30px; font-size: 24px; font-weight: 700; color: #222; }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; margin-bottom: 8px; color: #333; font-weight: 500; font-size: 14px; }
    .form-group input { width: 100%; padding: 12px 14px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px; outline: none; transition: border-color 0.3s ease; }
    .form-group input:focus { border-color: #4f46e5; }
    .btn { width: 100%; padding: 12px; border: none; border-radius: 8px; font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; }
    .btn-primary { background: #4f46e5; color: white; margin-top: 10px; }
    .btn-primary:hover { background: #4338ca; transform: translateY(-2px); box-shadow: 0 10px 20px rgba(79, 70, 229, 0.2); }
    .toggle-link { text-align: center; margin-top: 20px; color: #666; font-size: 14px; }
    .toggle-link a { color: #4f46e5; text-decoration: none; font-weight: 600; }
    .toggle-link a:hover { text-decoration: underline; }
  </style>
</head>
<body>
  <div class="container">
    <div class="form-box">
      <h2 class="form-title">Register</h2>
      
      <?php if (isset($_GET['error'])): ?>
          <p style="color: red; text-align: center; margin-bottom: 15px;"><?php echo htmlspecialchars($_GET['error']); ?></p>
      <?php endif; ?>

      <form method="POST" action="register.php">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="Choose a username" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Create a password" required>
        </div>
        <button type="submit" class="btn btn-primary">Sign Up</button>
      </form>
      <div class="toggle-link">
        Already have an account? <a href="Lab2/login.html">Login here</a>
      </div>
    </div>
  </div>
</body>
</html>

