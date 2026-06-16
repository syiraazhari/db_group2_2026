<?php
include 'connect_db.php';

if(isset($_POST['registerButton'])){
    $custName = $_POST['custName'];
    $email = $_POST['email'];
    $contactNo = $_POST['contactNo'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $date = date('Y-m-d');

    $check_sql = "SELECT * FROM customer WHERE Username = '$username' OR Email = '$email'";
    $check_result = mysqli_query($conn, $check_sql);
    
    if($check_result -> num_rows > 0) {
        echo "<script>alert('Username or email already exists'); 
        window.location.href='register.php';</script>";
        exit();
    }

    $sql = "INSERT INTO customer (CustomerName, Email, PhoneNo, 
            Address, Username, Password, AccountStatus, RegistrationDate)
            VALUES ('$custName', '$email', '$contactNo', '$address', 
            '$username', '$password', 'Active', '$date')";

    if(mysqli_query($conn, $sql)) {
        echo "<script>alert('Registration successful! Please login.'); 
        window.location.href='loginpage.php';</script>";
    } else {
        echo "<script>alert('Registration failed: " . mysqli_error($conn) . "'); 
        window.location.href='register.php';</script>";
    }
    
    mysqli_close($conn);
}
?>