<?php
// This file serves as the main entry point for the backend application.
// You can include any necessary initialization code or routing logic here.

require_once '../config/database.php';

// Example of initializing the database connection
$db = new Database();
$conn = $db->getConnection();

// You can add routing logic or include other files as needed
// For example, you might want to include controllers or set up a simple router

echo "Welcome to the Ecommerce App Backend!";
?>