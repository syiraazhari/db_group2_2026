<?php
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_name'])) {
    if(!isset($_SESSION['user_id'])) {
        header("Location: loginpage.php");
        exit();
    }
    
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];
    
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    $found = false;
    foreach($_SESSION['cart'] as $key => $item) {
        if($item['name'] == $product_name) {
            $_SESSION['cart'][$key]['quantity'] += $quantity;
            $found = true;
            break;
        }
    }
    
    if(!$found) {
        $_SESSION['cart'][] = array(
            'name' => $product_name,
            'price' => $product_price,
            'quantity' => $quantity
        );
    }
    
    echo "<script>alert('Added to cart!'); window.location.href='home.php#shop';</script>";
    exit();
}

if(!isset($_SESSION['user_id'])) {
    header("Location: loginpage.php");
    exit();
}

if(isset($_POST['clear_cart'])) {
    $_SESSION['cart'] = array();
    header("Location: cart.php");
    exit();
}

if(isset($_GET['remove'])) {
    unset($_SESSION['cart'][$_GET['remove']]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    header("Location: cart.php");
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
    header("Location: cart.php");
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
        echo "<script>alert('Order placed! Total: RM " . number_format($total, 2) . 
        "\\nThank you for shopping at MyFruits!'); window.location.href='home.php';</script>";
        $_SESSION['cart'] = array();
        exit();
    }
}

if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Cart - MyFruits</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #72c698;
            font-family: Verdana;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="home.php">MyFruits</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link active" href="cart.php">Cart</a></li>
            </ul>
            
            <div class="d-flex align-items-center">
                <span class="text-white me-3">
                    <i class="bi bi-person-circle me-1"></i> 
                    Welcome, <?php echo $_SESSION['username']; ?>
                </span>
                <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </div>
</nav>

<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h3 class="mb-0"><i class="bi bi-cart3 me-2"></i>Your Shopping Cart</h3>
        </div>
        <div class="card-body">
            <?php if(empty($_SESSION['cart'])): ?>
                <div class="text-center py-5">
                    <i class="bi bi-cart-x display-1 text-muted"></i>
                    <h4 class="mt-3">Your cart is empty</h4>
                    <a href="home.php#shop" class="btn btn-success mt-3">Continue Shopping</a>
                </div>
            <?php else: ?>
                <form method="POST">
                    <div class="table-responsive">
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
                                               min="0.5" step="0.5" style="width:80px" class="form-control">
                                    </td>
                                    <td>RM <?php echo number_format($subtotal, 2); ?></td>
                                    <td>
                                        <a href="?remove=<?php echo $index; ?>" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Remove this item?')">
                                            <i class="bi bi-trash"></i> Remove
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <tr class="table-success fw-bold">
                                    <td colspan="3" class="text-end fs-5">Total: </td>
                                    <td colspan="2" class="fs-4 text-success">RM 
                                        <?php echo number_format($total, 2); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-between mt-4">
                        <div>
                            <a href="home.php#shop" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Continue Shopping
                            </a>
                            <button type="submit" name="clear_cart" class="btn btn-danger" 
                            onclick="return confirm('Clear all items?')">
                                <i class="bi bi-trash3 me-1"></i> Clear Cart
                            </button>
                        </div>
                        <div>
                            <button type="submit" name="update_cart" class="btn btn-warning me-2">
                                <i class="bi bi-arrow-repeat me-1"></i> Update Cart
                            </button>
                            <button type="submit" name="checkout" class="btn btn-success">
                                <i class="bi bi-credit-card me-1"></i> Checkout
                            </button>
                        </div>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>