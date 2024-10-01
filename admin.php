<?php
session_start();
require 'db_connection.php';

// Check if admin is logged in
if ($_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Handle form submission for creating announcements with image upload
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = null;

    // Image upload handling
    if (!empty($_FILES['image']['name'])) {
        $image_name = basename($_FILES['image']['name']);
        $image_tmp = $_FILES['image']['tmp_name'];
        $upload_dir = 'uploads/';
        $image_path = $upload_dir . $image_name;

        // Move the uploaded image to the uploads directory
        if (move_uploaded_file($image_tmp, $image_path)) {
            $image = $image_path;
        }
    }

    if ($title && $content) {
        // Insert the announcement with image path into the database
        $stmt = $conn->prepare("INSERT INTO announcements (title, content, image) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $content, $image);
        $stmt->execute();
        $stmt->close();
        $_SESSION['message'] = "Announcement created successfully!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Please fill in all fields.";
        $_SESSION['message_type'] = "error";
    }

    // Redirect to avoid form resubmission
    header("Location: admin.php");
    exit();
}

// Handle deletion of announcements
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    // Fetch the announcement to delete the image
    $stmt = $conn->prepare("SELECT image FROM announcements WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($image);
    $stmt->fetch();
    $stmt->close();

    // Delete the announcement
    $stmt = $conn->prepare("DELETE FROM announcements WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    // Delete the image file if it exists
    if ($image && file_exists($image)) {
        unlink($image);
    }

    $_SESSION['message'] = "Announcement deleted successfully!";
    $_SESSION['message_type'] = "success";

    header("Location: admin.php");
    exit();
}

// Fetch all announcements
$result = $conn->query("SELECT * FROM announcements ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin - Create Announcement</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="admin.php">
            <img src="asiatech.png" alt="" style="width: 40px; height: 40px;">
            Asiatechnological
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Admin'; ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card p-4 shadow-lg">
            <h2 class="text-center mb-4">Create Announcement</h2>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" name="content" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Upload Image</label>
                    <input type="file" class="form-control" name="image" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Create Announcement</button>
            </form>
        </div>
        
        <div class="mt-5">
            <h3 class="text-center">Existing Announcements</h3>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="card mt-3 shadow-sm">
                    <div class="card-body">
                        <?php if (!empty($row['image'])): ?>
                            <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Announcement Image" class="img-fluid mb-3" style="max-height: 300px;">
                        <?php endif; ?>
                        <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
                        <p class="card-text"><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
                        <small class="text-muted">Posted on: <?php echo $row['created_at']; ?></small>
                        <!-- Delete button with SweetAlert confirmation -->
                        <button class="btn btn-danger btn-sm float-right" onclick="confirmDelete(<?php echo $row['id']; ?>)">Delete</button>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom JS for Delete Confirmation -->
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = 'admin.php?delete_id=' + id;
                }
            });
        }

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
