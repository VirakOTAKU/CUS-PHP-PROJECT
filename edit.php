<?php
// Database connection settings
$host = 'localhost';
$dbname = 'dbitem';
$username = 'root';
$password = '';

// Create connection
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fetch the coffee details
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the coffee data to edit
    $query = "SELECT * FROM item WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->execute(['id' => $id]);
    $coffee = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Handle form submission for editing
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Update the coffee entry in the database
    $query = "UPDATE item SET name = :name, price = :price WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->execute(['name' => $name, 'price' => $price, 'id' => $id]);

    // Redirect to index.php
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Coffee</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f6fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
            color: #2c3e50;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #34495e;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #dcdde1;
            border-radius: 5px;
            font-size: 16px;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus, input[type="number"]:focus {
            border-color: #3498db;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }

        a {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
        }

        a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Coffee</h1>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $coffee['id']; ?>">
            <label for="name">Coffee Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($coffee['name']); ?>" required>
            <label for="price">Price ($):</label>
            <input type="number" name="price" step="0.01" value="<?php echo $coffee['price']; ?>" required>
            <button type="submit">Update Coffee</button>
        </form>
        <a href="Index.php">Go Back</a>
    </div>
</body>
</html>
