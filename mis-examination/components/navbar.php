<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-brand">MSP examination</div>
        <ul class="navbar-links">
        <li><a href="#" class="menu-link" data-page="../admin/update.php">Update/Delete Questions</a></li>
        <li><a href="#" class="menu-link" data-page="../admin/registered-stud.php">Registered Students</a></li>
        <li><a href="#" class="menu-link" data-page="../admin/exam-results.php">Exam Results</a></li>
        </ul>
        <div class="navbar-user">
            <span class="admin-name">
                <?php echo isset($_SESSION['admin_username']) ? $_SESSION['admin_username'] : "Admin"; ?>
            </span>
            <!-- <a href="logout.php" class="logout-btn">Logout</a> -->
        </div>
    </div>
</nav>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    .navbar {
        background-color: #2980b9;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: white;
        font-family: 'Poppins', sans-serif;
    }
    .navbar-container {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .navbar-brand {
        font-size: 20px;
        font-weight: bold;
    }
    .navbar-links {
        list-style: none;
        display: flex;
        gap: 20px;
    }
    .navbar-links li {
        display: inline;
    }
    .navbar-links a {
        color: white;
        text-decoration: none;
        font-size: 16px;
    }
    .navbar-links a:hover {
        text-decoration: underline;
    }
    .navbar-user {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .admin-name {
        font-weight: bold;
    }
    .logout-btn {
        background-color: red;
        padding: 8px 12px;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: 0.3s;
    }
    .logout-btn:hover {
        background-color: darkred;
    }
</style>
