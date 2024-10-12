<?php
// Database connection settings
$host = 'localhost';
$dbname = 'dbitem';
$username = 'root';
$password = '';

// Create connection
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check if delete ID is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the coffee entry from the database
    $query = "DELETE FROM item WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->execute(['id' => $id]);

    // Redirect to index.php
    header("Location: dashboard.php");
    exit;
}
?>
