<?php 
include ("include/header.php");
require("include/connection.php");

if(isset($_POST['signup'])){
    
   $username= mysqli_real_escape_string($connection, $_POST['username']);
   $email= mysqli_real_escape_string($connection, $_POST['email']);
   $password= mysqli_real_escape_string($connection, $_POST['password']);

  $encrypedPassword=password_hash($password, PASSWORD_BCRYPT);

$check="SELECT * FROM users WHERE email='$email';";
$res=mysqli_query($connection,$check) or die("failed");

if(mysqli_num_rows($res) > 0){
    echo "<script>alert('Already registered. Please Login Now..!.')
    window.location.href='login.php';
    </script>;";
}
else{
   $insert="INSERT INTO `users`( `username`, `email`, `password`, `signup_date`)  VALUES ('$username','$email','$encrypedPassword', NOW());";
   $result=mysqli_query($connection , $insert) or die("failed to insert query.");
if($result){
   echo "<script>alert('Account Succesfully Created.')
   window.location.href='login.php';
   </script>;";
}
else{
    echo "<script>alert('Failed to Create your account.')</script>";
}}
}
?>









<body>
<div class="container">
<div class="wrapper">
<form id="signupForm" method="POST" action="signup.php">
    <h1>Signup</h1>
    
    <div class="input-box">
        <input type="text" id="username" name="username" placeholder="Username" required>
        <i class='bx bxs-user'></i>
        <p class="error-message"></p>
    </div>
    
    <div class="input-box">
        <input type="email" id="email" name="email" placeholder="Email" required>
        <i class='bx bxs-envelope'></i>
        <p class="error-message"></p>
    </div>

    <div class="input-box">
        <input type="password" id="password" name="password" placeholder="Password" required>
        <i class='bx bxs-lock-alt'></i>
        <span class="toggle-icon" onclick="togglePassword('password', this)">
            <i class="fa-solid fa-eye"></i>
        </span>
        <p class="error-message"></p>
    </div>

    <div class="input-box">
        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
        <i class='bx bxs-lock-alt'></i>
        <span class="toggle-icon" onclick="togglePassword('confirmPassword', this)">
            <i class="fa-solid fa-eye"></i>
        </span>
        <p class="error-message"></p>
    </div>

    <button type="submit" class="btn" name="signup">Sign Up</button>

    <div class="register-link">
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</form>
</div>
</div>
   <script src="css_java/java.js"></script>
</body>
</html>












<!-- <body>
    <div class="container my-4">
    <h1 class="text-center">Signup</h1>
<form action="" method="post" class="form-group">
<input type="text" name="username" id="" class="form-control my-2" placeholder="Enter username">
<input type="email" name="email" id="" class="form-control my-2" placeholder="Enter email">
<input type="password" name="password" id="" class="form-control my-2" placeholder="Enter a strong password">
<input type="submit" name="signup" id="" class="form-control btn btn-primary my-2">
</form>
</div>
</body>
</html> -->