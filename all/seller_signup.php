


<?php 


// include ("include/header.php");
require("include/connection.php");

if(isset($_POST['seller_signup'])) {
    
    // Prevent SQL injection
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $businessName = mysqli_real_escape_string($connection, $_POST['business_name']);
    $contactNumber = mysqli_real_escape_string($connection, $_POST['contact_number']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);

    // Password Hashing
    $encryptedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Check if Email Already Exists
    $check = "SELECT * FROM sellers WHERE email='$email'";
    $res = mysqli_query($connection, $check) or die("Query Failed");

    if(mysqli_num_rows($res) > 0) {
        echo "<script>alert('Email Already Registered. Please Login.');
        window.location.href='login.php';</script>";
    } else {
        // Handle File Upload
        $targetDir = "uploads/";
        $fileName = basename($_FILES["file_path"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Allowed file types (PDF, DOCX, JPG, PNG)
        $allowedTypes = array("jpg", "png", "jpeg", "pdf", "docx");

        if(in_array($fileType, $allowedTypes)) {
            if(move_uploaded_file($_FILES["file_path"]["tmp_name"], $targetFilePath)) {
                // Insert Data into Database
                $insert = "INSERT INTO `sellers`(`username`, `email`, `password`, `business_name`, `contact_number`, `address`, `file_path`, `created_at`) 
                VALUES ('$username','$email','$encryptedPassword','$businessName','$contactNumber','$address','$targetFilePath', NOW())";

                $result = mysqli_query($connection, $insert) or die("Query Failed" . mysqli_error($connection));

                if($result) {
                    echo "<script>alert('Account Successfully Created.');
                    window.location.href='login.php';</script>";
                } else {
                    echo "<script>alert('Failed to Create Account.');</script>";
                }
            } else {
                echo "<script>alert('File Upload Failed.');</script>";
            }
        } else {
            echo "<script>alert('Invalid File Type. Only JPG, PNG, PDF, DOCX allowed.');</script>";
        }
    }
}
?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css_java/seller_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>
    
<div class="container">
<div class="wrapper">

<form id="sellerForm" method="POST" action="seller_signup.php" enctype="multipart/form-data">
    <h1>Seller Registration</h1>
    
    <div class="input-box">
        <input type="text" id="username" name="username" placeholder="Username" required>
        <i class='bx bxs-user'></i>
        <span class="error-message"></span>
    </div>
    
    <div class="input-box">
        <input type="email" id="email" name="email" placeholder="Email" required>
        <i class='bx bxs-envelope'></i>
        <span class="error-message"></span>
    </div>

    <div class="input-box">
        <input type="password" id="password" name="password" placeholder="Password" required>
        <span class="eye-icon" onclick="togglePassword('password', this)">
            <i class="fa-solid fa-eye"></i>
        </span>
        <span class="error-message"></span>
    </div>

    <div class="input-box">
        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
        <span class="eye-icon" onclick="togglePassword('confirmPassword', this)">
            <i class="fa-solid fa-eye"></i>
        </span>
        <span class="error-message"></span>
    </div>

    <div class="input-box">
        <input type="text" id="businessName" name="business_name" placeholder="Business Name" required>
        <i class='bx bxs-briefcase'></i>
        <span class="error-message"></span>
    </div>

    <div class="input-box">
        <input type="tel" id="contactNumber" name="contact_number" placeholder="Contact Number" required>
        <i class='bx bxs-phone'></i>
        <span class="error-message"></span>
    </div>

    <div class="input-box">
        <input type="text" id="address" name="address" placeholder="Address" required>
        <i class='bx bxs-map'></i>
        <span class="error-message"></span>
    </div>






    <div class="input-box file-input-container">
    <label for="fileUpload" class="file-label">Choose File</label>
    <input type="file" id="fileUpload" name="file_path" onchange="updateFileName()" required>
    <span id="file-name">No file chosen</span>
    <span class="error-message">Please select a file!</span> <!-- Error Message Span -->
</div>

 
    <button type="submit" class="btn" name="seller_signup">Register</button>

    <div class="register-link">
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</form>
</div>
</div>
    <script src="css_java/script.js"></script>
</body>
</html>



























