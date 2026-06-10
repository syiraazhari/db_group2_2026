<?php
if(isset($_POST['registerButton'])){
    $conn = mysqli_connect('localhost', 'root', '', 'fruit_grocery_db');

    $custName = $_POST['custName'];
    $email = $_POST['email'];
    $contactNo = $_POST['contactNo'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO CUSTOMER (CustomerName, Email, PhoneNo, 
            Address, Username, Password)
    VALUES ('$custName', '$email', '$contactNo', 
            '$address', '$username', '$password')";

    mysqli_query($conn, $sql);
}
?>