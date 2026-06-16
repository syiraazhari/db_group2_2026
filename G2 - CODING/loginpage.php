<?php
session_start();
include 'connect_db.php';

if(isset($_POST['signInButton'])) {
    $loginName = $_POST['loginName'];
    $loginPassword = $_POST['loginPassword'];
    
    $sql = "SELECT * FROM customer WHERE Username = '$loginName' OR Email = '$loginName'";
    $result = mysqli_query($conn, $sql);
    
    if($result -> num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        if($loginPassword == $row['Password']) {
            $_SESSION['user_id'] = $row['CustomerID'];
            $_SESSION['username'] = $row['Username'];
            header("Location: home.php");
            exit();
        } 
        else {
            $error = "Invalid password";
        }
    } 
    else {
        $error = "Username or email not found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  
  <style>
    body {
      background-color: #72C698;
    }
  </style>
</head>
<body>

<h1 style="margin:20px;">Login to Your Account</h1>

<div style="margin:20px;">
  <form method="POST">
    <input type="text" name="loginName" class="form-control w-50 mb-3" placeholder="Username or Email" required><br>
    <input type="password" name="loginPassword" class="form-control w-50 mb-3" placeholder="Password" required><br>
    <input type="submit" name="signInButton" value="Sign in" class="btn btn-primary">
    <p class="mt-3"><a href = "admin_login.php">Login as Admin</a></p>
    <p class="mt-3">Not a member? <a href="register.php">Register</a></p>
  </form>
</div>

</body>
</html>