<?php
session_start();
include 'connect_db.php';

if(isset($_POST['signInButton'])){
  $loginName = $_POST['loginName'];
  $loginPassword = $_POST['loginPassword'];

  $sql = "SELECT * FROM CUSTOMER
          WHERE Username = $loginName OR Email = $loginName";
  $result = mysqli_query($conn, $sql);

  if($result -> num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        if(password_verify($loginPassword, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: home.php");
            exit();
        } 
        else {
            $error = "Invalid password";
        }
    } else {
        $error = "Username or email not found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <link rel="stylesheet" 
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" >

<style>
    body {
        background-color: #72c698;
        font-family: Verdana;
    }
</style>
</head>

<body>
<h1 style = "margin: 20px;"><b>Login to Your Account</b></h1>
<hr style = "width: 2px;">

<div class="tab-content" style = "margin: 20px;">
  <div class="tab-pane fade show active">
    <form action = "" method = "POST">
      <div data-mdb-input-init class="col-md-6 mb-4">
        <label>Username or Email</label>
        <input type="text" name="loginName" class = "form-control " required><br>
      </div>

      <div data-mdb-input-init class="col-md-6 mb-4">
        <label>Password</label>
        <input type="password" name="loginPassword" class = "form-control" required><br>
      </div>

      <div data-mdb-input-init class="col-md-6 mb-4">
      <input type="submit" data-mdb-button-init data-mdb-ripple-init 
      name = "signInButton" value = "Sign in" class="btn btn-primary btn-block mb-4">
      </div>

        <p>Not a member? <a href="register.php">Register</a></p>
    </form>
  </div>
</div>
</body>
</html>