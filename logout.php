<?php
session_start();
session_destroy();
header("Location: Lab2/login.html");
exit();
?>
