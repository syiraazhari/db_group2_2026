<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <link rel = "stylesheet" 
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" >

<style>
    body {
        background-color: powderblue;
        font-family: Verdana;
    }
</style>
</head>

<body>
<h1 style = "margin: 20px;">Login to Your Account</h1>
<hr style = "width: 2px;">

<div class="tab-content" style = "margin: 20px;">
  <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
    <form action = "" method = "POST">
      <div data-mdb-input-init class="col-md-6 mb-4">
        <label>Username</label>
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

        <p>Don't have an account? <a href="register.php">Register</a></p>
    </form>
  </div>
</div>
</body>
</html>