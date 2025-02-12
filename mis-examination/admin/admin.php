<?php
session_start();
include '../db/dbcon.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/admin.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
</head>
<body>

<div class="dashboard-container">
    <!-- Sidebar -->
    <?php include '../components/navbar.php'; ?>

    <!-- Main Content Area -->
    <div class="main-content">
        <div id="dynamic-content">
            <h2>Welcome to the Admin Dashboard</h2>
            <p>This side are use for analytics side</p>
        </div>
    </div>
</div>

<script src="../js/dynamic-page.js"></script>

</body>
</html>