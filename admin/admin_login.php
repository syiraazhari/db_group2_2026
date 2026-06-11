<?php
session_start();
include 'connect_db.php';

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM admin 
    WHERE Username = '$username' 
    AND Password = '$password'";
    $result = mysqli_query($conn, $sql);
    
    if($result -> num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['admin_id'] = $row['AdminID'];
        $_SESSION['admin_username'] = $row['Username'];
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #72c698;
            font-family: Verdana;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Admin Login</h4>
                </div>
                <div class="card-body">
                    <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
                    <form method="POST">
                        <input type="text" name="username" 
                        class="form-control mb-3" placeholder="Username" required>
                        <input type="password" name="password" 
                        class="form-control mb-3" placeholder="Password" required>
                        <button type="submit" name="login" 
                        class="btn btn-success w-100">Login</button>
                        <a href="home.php" class="btn btn-secondary w-100 mt-2">Back to Store</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>