<?php 
include ("include/header.php");
require("include/connection.php");
 //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

function sendRecoveryLink($token, $email, $username){
    //Load Composer's autoloader
    require '../vendor/autoload.php';
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();                               //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'owais1566@gmail.com';                     //SMTP username
        $mail->Password   = 'ptpv ulnh bmko tqwa';                               //SMTP password
        $mail->SMTPSecure = 'TLS';            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = 
        //Recipients
        $mail->setFrom('owais1566@gmail.com', 'The CODERS');
        $mail->addAddress($email, $username);     //Add a recipient
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'PASSWORD RECOVERY REQUEST';
        $mail->Body    = 'A request has been generated to reset your password. Please <b><a href="http://localhost:82/phpclass/login/resetpass.php?token='.$token.'&email='.$email.'">Click here</a></b> to reset your password.';
                             
        $mail->send();
        echo '
        <script>alert("Email has been sent to you at '.$email.'. Please check your inbox")</script>
        ';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

}

if(isset($_POST['sendlink']) && $_SERVER['REQUEST_METHOD']=="POST"){
   $email= mysqli_real_escape_string($connection, $_POST['recoveryemail']);
   $token=md5(rand());

   $check="SELECT * FROM users WHERE email='$email';";
   $result=mysqli_query($connection , $check) or die("failed to insert query.");

if($result){
if(mysqli_num_rows($result) > 0){
$row=mysqli_fetch_assoc($result);
$username=$row['username'];

$updatetoken="UPDATE `users` SET `token`='$token' WHERE email='$email'; ";
$updatetoken_run=mysqli_query($connection, $updatetoken) or die("faile to execute");
if($updatetoken_run){
    sendRecoveryLink($token, $email,$username);
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
            <form id="forgetForm" action="forgetpass.php" method="POST">
                <h1>Forget Password</h1>
                <p>Enter your email to reset your password</p>
                <div class="input-box">
                    <input type="email" name="recoveryemail" placeholder="Email" required>
                    <i class='bx bxs-envelope'></i>
                </div>
                <button type="submit" class="btn" name="sendlink">Reset Password</button>
                <div class="register-link">
                    <p>Remember your password? <a href="login.php">Login</a></p>
                </div>
            </form>
        </div>
    </div>
    <script src="css_java/java.js"></script>
</body>
</html>

