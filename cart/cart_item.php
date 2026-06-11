<?php
session_start();
include 'connect_db.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: loginpage.php");
    exit();
}

if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if(isset($_POST['clear_cart'])) {
    $_SESSION['cart'] = array();
    header("Location: cart_item.php");
    exit();
}

if(isset($_GET['remove'])) {
    unset($_SESSION['cart'][$_GET['remove']]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    header("Location: cart_item.php");
    exit();
}

if(isset($_POST['update_cart'])) {
    foreach($_POST['quantity'] as $index => $qty) {
        if($qty <= 0) {
            unset($_SESSION['cart'][$index]);
        } else {
            $_SESSION['cart'][$index]['quantity'] = $qty;
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    header("Location: cart_item.php");
    exit();
}

if(isset($_POST['checkout'])) {
    if(empty($_SESSION['cart'])) {
        echo "<script>alert('Cart is empty!');</script>";
    } else {
        $total = 0;
        foreach($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        echo "<script>alert('Order placed! Total: RM " . number_format($total, 2) 
        . "\\nThank you for shopping at MyFruits!'); window.location.href='home.php';</script>";
        $_SESSION['cart'] = array();
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Cart</title>
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
        <a class="navbar-brand" href="home.php"><b>MyFruits</b></a>
        <div>
            <span class="text-white me-3">Welcome, <?php echo $_SESSION['username']; ?></span>
            <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-white">
            <h3>Shopping Cart</h3>
        </div>
        <div class="card-body">
            
            <!-- Debug: Show cart count -->
            <div class="alert alert-info">
                Items in cart: <?php echo count($_SESSION['cart']); ?>
            </div>
            
            <?php if(empty($_SESSION['cart'])): ?>
                <div class="text-center py-5">
                    <h4>Your cart is empty</h4>
                    <a href="home.php#shop" class="btn btn-success mt-3">Continue Shopping</a>
                </div>
            <?php else: ?>
                <form method="POST">
                    <table class="table table-bordered">
                        <thead class="table-success">
                            <tr>
                                <th>Product</th>
                                <th>Price (RM/kg)</th>
                                <th>Quantity (kg)</th>
                                <th>Subtotal (RM)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $total = 0;
                            foreach($_SESSION['cart'] as $index => $item): 
                                $subtotal = $item['price'] * $item['quantity'];
                                $total += $subtotal;
                            ?>
                            <tr>
                                <td><?php echo $item['name']; ?></td>
                                <td>RM <?php echo number_format($item['price'], 2); ?></td>
                                <td>
                                    <input type="number" name="quantity[<?php echo $index; ?>]" 
                                           value="<?php echo $item['quantity']; ?>" 
                                           min="0.5" step="0.5" style="width:80px">
                                 </td>
                                <td>RM <?php echo number_format($subtotal, 2); ?></td>
                                <td>
                                    <a href="?remove=<?php echo $index; ?>" 
                                    class="btn btn-danger btn-sm" 
                                    onclick="return confirm('Remove this item?')">Remove</a>
                                 </td>
                            </tr>
                            <?php endforeach; ?>
                            <tr class="table-success fw-bold">
                                <td colspan="3" class="text-end">Total:</td>
                                <td colspan="2">RM <?php echo number_format($total, 2); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="home.php#shop" class="btn btn-secondary">Continue Shopping</a>
                            <button type="submit" name="clear_cart" 
                            class="btn btn-danger" 
                            onclick="return confirm('Clear all items?')">Clear Cart</button>
                        </div>
                        <div>
                            <button type="submit" name="update_cart" class="btn btn-warning">Update Cart</button>
                            <button type="submit" name="checkout" class="btn btn-success">Checkout</button>
                        </div>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>
</body>
</html>