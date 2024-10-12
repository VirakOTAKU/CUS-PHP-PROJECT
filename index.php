<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
    font-family: Arial, sans-serif;
    background-image: url("https://img.freepik.com/free-vector/background-wave-minimalist-modern-style_483537-5220.jpg");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;  
    margin: 0;  
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f0f0f0;  
}


        .container {
            width: 400px;
            padding: 30px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.7);
            border-radius: 40px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 27px;
            color: #333;
        }

        label {
            font-size: 14px;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 16px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php
        session_start();
        $error = '';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Example hardcoded credentials for testing
            $valid_username = 'admin';
            $valid_password = 'password123';

            if ($username == $valid_username && $password == $valid_password) {
                $_SESSION['loggedin'] = true;
                header("Location: dashboard.php"); // Redirect to Index.php after successful login
                exit;
            } else {
                $error = 'Invalid username or password';
            }
        }
        ?>
        <form method="post" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <?php if ($error): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>

            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
