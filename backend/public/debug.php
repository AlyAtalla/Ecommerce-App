<?php
// File: public/debug.php
header('Content-Type: text/plain');

echo "Server Information:\n";
echo "----------------\n";
echo "PHP Version: " . PHP_VERSION . "\n";
echo "Server API: " . PHP_SAPI . "\n";
echo "Operating System: " . PHP_OS . "\n\n";

echo "Request Information:\n";
echo "------------------\n";
echo "Request Method: " . ($_SERVER['REQUEST_METHOD'] ?? 'N/A') . "\n";
echo "Request URI: " . ($_SERVER['REQUEST_URI'] ?? 'N/A') . "\n";
echo "Query String: " . ($_SERVER['QUERY_STRING'] ?? 'N/A') . "\n\n";

echo "Directory Information:\n";
echo "--------------------\n";
echo "Current Directory: " . getcwd() . "\n";
echo "Script Directory: " . __DIR__ . "\n\n";

echo "File Existence Checks:\n";
echo "--------------------\n";
$checkFiles = [
    'index.php' => __DIR__ . '/index.php',
    'router.php' => __DIR__ . '/router.php',
    'index.html' => __DIR__ . '/index.html'
];

foreach ($checkFiles as $name => $path) {
    echo "$name: " . (file_exists($path) ? "EXISTS" : "NOT FOUND") . "\n";
}