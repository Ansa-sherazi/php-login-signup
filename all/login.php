<?php 
include ("include/header.php");
require("include/connection.php");
if(isset($_POST['login.php']) && $_SERVER['REQUEST_METHOD']=="POST"){
   $email= mysqli_real_escape_string($connection, $_POST['email']);
  $password= mysqli_real_escape_string($connection, $_POST['password']);
   $check="SELECT * FROM users WHERE email='$email';";
   $result=mysqli_query($connection , $check) or die("failed to insert query.");
if($result){
if(mysqli_num_rows($result) == 1){
$row=mysqli_fetch_assoc($result);
$regUsername=$row['username'];
$regEmail=$row['email'];
$regPass=$row['password'];//hash
$verifyPass=password_verify($password, $regPass);
if($verifyPass){
    session_start();
    $_SESSION['email']=$regEmail;
    $_SESSION['username']=$regUsername;
       echo "<script>alert('Successfully logged in.')
       window.location.href='home.php';</script>";  
}else{
    echo "<script>alert('Invalid Credentials.')</script>;";
}
}
else{
     echo "<script>alert('Pehle account bana kr aao.')
       window.location.href='signup.php';</script>;";
}
}}
?>







<body>
    <div class="container">
        <div class="wrapper">
            <form id="loginForm" method="POST" action="login.php">
                <h1>Login</h1>
                <div class="input-box">
                    <input type="email" name="email" id="loginEmail" placeholder="Email" required>
                    <i class='bx bxs-user'></i>
                    <p class="error-message"></p> <!-- Error Message -->
                </div>
                <div class="input-box">
                    <input type="password" name="password" id="loginPassword" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                    <span class="toggle-icon" onclick="togglePassword('loginPassword', this)">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                    <p class="error-message"></p> <!-- Error Message -->
                </div>
                <div class="forgot-password">
                    <a href="forgetpass.php">Forgot Password?</a> 
                </div>
                <button type="submit" class="btn" name="signin">Login</button>
                <div class="register-link">
                    <p>New User? <a href="signup.php">User Signup</a></p>
                    <p>Want to sell? <a href="seller_signup.php">Seller Signup</a></p>
                </div>
            </form>
        </div>
    </div>

   <script src="css_java/java.js"></script>
</body>
</html>
