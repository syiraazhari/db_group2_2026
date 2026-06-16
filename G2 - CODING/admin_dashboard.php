<?php
session_start();
include 'connect_db.php';

if(!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

if(isset($_POST['add_product'])) {
    $name = $_POST['product_name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $categoryID = $_POST['category_id'];
    $description = $_POST['description'];
    $date = date('Y-m-d');
    
    $sql = "INSERT INTO product (ProductName, Price, StockQuantity, CategoryID, Description, DateAdded) 
            VALUES ('$name', '$price', '$stock', '$categoryID', '$description', '$date')";
    
    if(mysqli_query($conn, $sql)) {
        $success = "Product added successfully!";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}

if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM product WHERE ProductID = $id");
    header("Location: admin_dashboard.php");
    exit();
}

if(isset($_POST['update_product'])) {
    $id = $_POST['product_id'];
    $name = $_POST['product_name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $categoryID = $_POST['category_id'];
    $description = $_POST['description'];
    
    $sql = "UPDATE product SET ProductName='$name', 
    Price='$price', StockQuantity='$stock', 
    CategoryID='$categoryID', Description='$description' WHERE ProductID=$id";
    mysqli_query($conn, $sql);
    header("Location: admin_dashboard.php");
    exit();
}

$products = mysqli_query($conn, "SELECT p.*, 
c.CategoryName FROM product p LEFT JOIN category c 
ON p.CategoryID = c.CategoryID 
ORDER BY p.ProductID DESC");
$categories = mysqli_query($conn, "SELECT * FROM category");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #72c698;
            font-family: Verdana;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-success p-3">
    <div class="container">
        <a class="navbar-brand" href="admin_dashboard.php">Admin Dashboard - MyFruits</a>
        <div>
            <span class="text-white me-3">Welcome, 
                <?php echo $_SESSION['admin_username']; ?></span>
            <a href="admin_logout.php" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Add New Product</h5>
                </div>
                <div class="card-body">
                    <?php if(isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
                    <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
                    
                    <form method="POST">
                        <input type="text" name="product_name" class="form-control mb-2" placeholder="Product Name" required>
                        <input type="number" step="0.01" name="price" class="form-control mb-2" placeholder="Price (RM)" required>
                        <input type="number" name="stock" class="form-control mb-2" placeholder="Stock Quantity (kg)" required>
                        <select name="category_id" class="form-control mb-2" required>
                            <option value="">Select Category</option>
                            <?php while($cat = mysqli_fetch_assoc($categories)): ?>
                                <option value="<?php echo $cat['CategoryID']; ?>">
                                <?php echo $cat['CategoryName']; ?></option>
                            <?php endwhile; ?>
                        </select>
                        <textarea name="description" class="form-control mb-2" 
                        rows="2" placeholder="Product Description"></textarea>
                        <button type="submit" name="add_product" 
                        class="btn btn-success w-100">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Product List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-success">
                                <tr>
                                    <th>ID</th><th>Name</th><th>Category</th>
                                    <th>Price</th><th>Stock</th><th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $categories2 = mysqli_query($conn, "SELECT * FROM category");
                                $catArray = [];
                                while($c = mysqli_fetch_assoc($categories2)) {
                                    $catArray[$c['CategoryID']] = $c['CategoryName'];
                                }
                                while($row = mysqli_fetch_assoc($products)): 
                                ?>
                                <tr>
                                    <form method="POST" style="display: inline;">
                                        <td><?php echo $row['ProductID']; ?></td>
                                        <td><input type="text" name="product_name" 
                                        value="<?php echo $row['ProductName']; ?>" 
                                        class="form-control form-control-sm" style="width:120px"></td>
                                        <td>
                                            <select name="category_id" class="form-control form-control-sm" style="width:100px">
                                                <?php foreach($catArray as $cid => $cname): ?>
                                                    <option value="<?php echo $cid; ?>" 
                                                    <?php echo ($cid == $row['CategoryID']) ? 'selected' : ''; ?>>
                                                    <?php echo $cname; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td><input type="number" step="0.01" name="price" value="<?php echo $row['Price']; ?>" 
                                        class="form-control form-control-sm" style="width:80px"></td>
                                        <td><input type="number" name="stock" value="<?php echo $row['StockQuantity']; ?>" 
                                        class="form-control form-control-sm" style="width:70px"></td>
                                        <td>
                                            <input type="hidden" name="product_id" value="<?php echo $row['ProductID']; ?>">
                                            <input type="hidden" name="description" value="<?php echo $row['Description']; ?>">
                                            <button type="submit" name="update_product" class="btn btn-warning btn-sm">Update</button>
                                            <a href="?delete=<?php echo $row['ProductID']; ?>" class="btn btn-danger btn-sm" 
                                            onclick="return confirm('Delete this product?')">Delete</a>
                                        </td>
                                    </form>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>