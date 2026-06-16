<!DOCTYPE html>
<html>
<head>
    <title>Customer Registration</title>
    <link rel = "stylesheet" 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: lightgray;
            font-family: Verdana;
        }

        .registration-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 24px gray;
        }

        .btn-success {
            background-color: #008CBA;
            border: none;
            padding: 10px 20px;
            font-weight: 600;
            border-radius: 6px;
        }

        .btn-success:hover {
            background-color: #3098BB;
        }
        
        .btn-secondary {
            background-color: #6c757d;
            border: none;
            padding: 10px 20px;
            font-weight: 600;
            border-radius: 6px;
            color: white;
            width: 100%;
        }
        
        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            
            <div class="card registration-card p-4 bg-white">
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-success">Customer Registration</h2>
                </div>

                <form action="addNewCustomer.php" method="POST">
                    <div class="mb-3">
                        <label for="custId" 
                        class="form-label text-secondary fw-semibold">Customer ID</label>
                        <input type="text" class="form-control bg-light" name="custId" 
                        placeholder = "System auto-generated" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="custName" class="form-label fw-semibold">Name*</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="custName" 
                            placeholder = "e.g. Michael Jackson" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="custName" class="form-label fw-semibold">Email*</label>
                        <div class="input-group">
                            <input type="email" class="form-control" name="email" 
                            placeholder = "e.g. michael@gmail.com" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="contactNo" class="form-label fw-semibold">Contact No*</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="contactNo"
                            placeholder = "e.g. 0123456789" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label fw-semibold">Address*</label>
                        <div class="input-group">
                            <input type = "text" class="form-control" name="address"
                            placeholder = "Kuala Lumpur" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label fw-semibold">Username*</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="username" 
                            placeholder = "e.g. michael" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">Password*</label>
                        <div class="input-group">
                            <input type="password" class="form-control" 
                            name="password" minlength = "5" maxlength = "32" 
                            placeholder = "Minimum 5 characters" required>
                        </div>
                    </div>

                    <p>* Required</p>

                    <div class="d-grid gap-2">
                        <button type="submit" name="registerButton" class="btn btn-success">
                        Register</button>
                    </div>

                    <div class="d-grid gap-2 mt-2">
                        <button type="button" onclick="window.location.href='loginpage.php';" 
                        class="btn btn-secondary">Cancel</button>
                    </div>
                </form>
            </div> 
        </div>
    </div>
</div>
</body>

</html>