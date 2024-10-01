<?php
session_start();
require 'db_connection.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation
    if ($username && $password && $confirm_password) {
        if ($password === $confirm_password) {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Check if username already exists
            $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $_SESSION['message'] = "Username already exists!";
                $_SESSION['message_type'] = "error";
            } else {
                // Insert new user into the database
                $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'student')");
                $stmt->bind_param("ss", $username, $hashed_password);
                $stmt->execute();
                $stmt->close();

                $_SESSION['message'] = "Registration successful! You can now log in.";
                $_SESSION['message_type'] = "success";

                header('Location: login.php');
                exit();
            }
        } else {
            $_SESSION['message'] = "Passwords do not match!";
            $_SESSION['message_type'] = "error";
        }
    } else {
        $_SESSION['message'] = "Please fill in all fields!";
        $_SESSION['message_type'] = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .card {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .card-title {
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2 class="card-title">Register</h2>
        <form method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
            <p class="text-center mt-3">
                Already have an account? <a href="login.php">Log in</a>
            </p>
        </form>
    </div>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if (isset($_SESSION['message'])): ?>
            Swal.fire({
                icon: '<?php echo $_SESSION['message_type']; ?>',
                title: '<?php echo $_SESSION['message_type'] == "success" ? "Success!" : "Error!"; ?>',
                text: '<?php echo $_SESSION['message']; ?>',
            });
            <?php unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
        <?php endif; ?>
    </script>
</body>
</html>
