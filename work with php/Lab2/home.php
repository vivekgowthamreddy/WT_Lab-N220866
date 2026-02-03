<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="style1.css" />
</head>

<body>
  <div class="app">

    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="sidebar-logo">
        <h2>Admin Panel</h2>
      </div>

      <nav class="sidebar-menu">
        <ul>
          <li>
            <span class="icon">📊</span>
            <span class="label">Dashboard</span>
          </li>
          <li>
            <span class="icon">👥</span>
            <span class="label">Students</span>
          </li>
          <li>
            <span class="icon">✓</span>
            <span class="label">Attendance</span>
          </li>
        </ul>
      </nav>

      <div class="sidebar-footer">
        <p>&copy; 2025 Admin Dashboard</p>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="main">

      <!-- Topbar -->
      <header class="topbar">
        <div class="topbar-left">
          <input type="text" placeholder="Search..." />
        </div>

        <div class="topbar-right">
          <div class="user-profile">
            <img src="images/avatar.jpg" alt="Avatar" class="avatar" />
            <div class="user-info">
              <p class="user-name"><?php echo htmlspecialchars($_SESSION['username']); ?></p>
              <p class="user-role">Administrator</p>
            </div>
          </div>
          <a href="../logout.php" class="btn-logout">Logout</a>
        </div>
      </header>

      <!-- Content Area -->
      <section class="content">
        <div class="content-header">
          <h1>Dashboard</h1>
          <p>Welcome back, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        </div>

        <div class="stats">
          <div class="stat-card">
            <h3>Total Students</h3>
            <p id="total-count">0</p>
          </div>
          <div class="stat-card">
            <h3>Present Today</h3>
            <p id="present">0</p>
          </div>
          <div class="stat-card">
            <h3>Absent Today</h3>
            <p id="absent">0</p>
          </div>
        </div>
      </section>
    </main>
  </div>

  <script src="javascript(lab4).js"></script>
</body>
</html>
