<?php
// Database connection settings
$host = 'localhost';
$dbname = 'dbitem';
$username = 'root'; // Your MySQL username
$password = ''; // Your MySQL password

// Create connection
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Query the database to fetch coffee data
$query = "SELECT * FROM item";
$stmt = $conn->prepare($query);
$stmt->execute();
$coffees = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Dashboard</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-image: url("https://static.vecteezy.com/system/resources/previews/008/311/935/non_2x/the-illustration-graphic-consists-of-abstract-background-with-a-blue-gradient-dynamic-shapes-composition-eps10-perfect-for-presentation-background-website-landing-page-wallpaper-vector.jpg");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

        .dashboard {
            background-color: white;
            padding: 60px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            
        }

        table, th, td {
            border: 3px solid #ddd;
        }

        th, td {
            padding: 20px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"], input[type="number"] {
            padding: 10px;
            margin-right: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        button {
            padding: 10px 15px;
            border-radius: 5px;
            border: none;
            background-color: #5cb85c;
            color: white;
            cursor: pointer;
        }

        button.edit-btn {
            background-color: #0275d8;
        }

        button.delete-btn {
            background-color: #d9534f;
        }

    </style>
</head>
<body>
<div class="dashboard">
    <h1>ITEM MENU</h1>

    <!-- Link to Add New Coffee -->
    <a href="add.php"><button>ITEM MENU</button></a>

    <table>
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Price ($)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($coffees as $coffee): ?>
            <tr>
                <td><?php echo htmlspecialchars($coffee['name']); ?></td>
                <td><?php echo number_format($coffee['price'], 2); ?></td>
                <td>
                    <!-- Link to Edit Coffee -->
                    <a href="edit.php?id=<?php echo $coffee['id']; ?>"><button class="edit-btn">Edit</button></a>

                    <!-- Link to Delete Coffee -->
                    <a href="delete.php?id=<?php echo $coffee['id']; ?>" onclick="return confirm('Are you sure?');">
                        <button class="delete-btn">Delete</button>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
