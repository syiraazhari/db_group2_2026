<?php
session_start();
include 'connect_db.php';

$result = mysqli_query($conn, "SELECT * FROM product");
?>

<!DOCTYPE html>
<head>
    <title>Welcome to MyFruits</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #72c698;
            font-family: Verdana;
        }
        .fruit-card {
            border: none;
            border-radius: 10px;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="home.php">MyFruits</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link active" href="home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#shop">Shop Now</a></li>
            </ul>
            
            <div class="d-flex align-items-center">
                <?php if(isset($_SESSION['username'])): ?>
                    <span class="text-white me-3">
                        <i class="bi bi-person-circle me-1"></i> 
                        Welcome, <?php echo $_SESSION['username']; ?>
                    </span>
                    <a href="cart.php" class="btn btn-light btn-sm text-success fw-bold me-2">
                        <i class="bi bi-cart3 me-1"></i> Cart
                    </a>
                    <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
                <?php else: ?>
                    <a href="loginpage.php" class="btn btn-outline-light btn-sm me-2">Login</a>
                    <a href="register.php" class="btn btn-light text-success btn-sm fw-bold">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<div class="bg-success text-white py-5 text-center mb-5">
    <div class="container">
        <h1 class="display-5 fw-bold">Welcome to MyFruits!</h1>
        <p class="lead">We produce fresh fruits everyday.</p>
        <a href="#shop" class="btn btn-warning fw-bold px-4">Browse Our Products</a>
    </div>
</div>

<div class="container my-5" id="shop">
    <h3 class="fw-bold text-center mb-4">Our Products</h3>
    
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="col">
                <div class="card h-100 shadow-sm fruit-card">
                    <img src="<?php echo $row['ImageFilename']; ?>" 
                         class="card-img-top p-2" style="height: 180px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold"><?php echo $row['ProductName']; ?></h5>
                        <p class="text-success fw-bold fs-5 mb-3">RM <?php echo $row['Price']; ?> / kg</p>
                        
                        <form action="cart.php" method="POST" class="mt-auto">
                            <input type="hidden" name="product_name" value="<?php echo $row['ProductName']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $row['Price']; ?>">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text">Qty (kg)</span>
                                <input type="number" class="form-control text-center" 
                                name="quantity" value="1" min="0.5" step="0.5">
                            </div>
                            <button type="submit" class="btn btn-success btn-sm w-100">
                                <i class="bi bi-cart-plus me-1"></i> Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>