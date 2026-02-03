<?php
echo "<h2>String Functions Demo</h2>";

$text = "  Hello PHP World  ";

echo "Original String: '$text'<br><br>";

// Basic String Functions
echo "Length: " . strlen($text) . "<br>";
echo "Word Count: " . str_word_count($text) . "<br>";
echo "Reverse: " . strrev($text) . "<br><br>";

// Case Conversion
echo strtoupper($text) . "<br>";
echo strtolower($text) . "<br>";
echo ucfirst("php") . "<br>";
echo ucwords("php string functions") . "<br><br>";

// Search & Replace
echo "Position of PHP: " . strpos($text, "PHP") . "<br>";
echo str_replace("World", "Programming", $text) . "<br><br>";

// Substring & Trimming
echo substr($text, 2, 5) . "<br>";
echo "Trim: '" . trim($text) . "'<br>";
echo "Left Trim: '" . ltrim($text) . "'<br>";
echo "Right Trim: '" . rtrim($text) . "'<br><br>";

// String Comparison
echo strcmp("admin", "Admin") . "<br>";
echo strcasecmp("admin", "Admin") . "<br><br>";

// Security Functions
$unsafe = "<script>alert('hack')</script>";
echo htmlspecialchars($unsafe) . "<br>";
echo addslashes("O'Reilly") . "<br>";
?>
