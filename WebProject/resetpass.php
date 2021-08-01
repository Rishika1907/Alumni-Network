<?php
// Start the session
session_start();

$log_err=false;
$pass_error=false;

if(isset($_POST['Submit'])){
    // Include the connection.php to this page
    include("connection.php");
 
 // Check connection
 if (!$conn) {
   die("Connection failed: " . $conn->mysqli_connect_error());
 }

//    Get the data from the form
   $email=$_POST['email'];
   $secret=$_POST['secret'];

// Read the session variable
    $_SESSION['email']=$email;
    
// Check whether the email entered is registered and data entered is proper
   $result = mysqli_query($conn,"SELECT * FROM register WHERE email = '$email' and secre ='$secret'");
   $row = mysqli_num_rows($result);
   if($row == 0){
    $log_err=true;
      }
    else{
        header("location:frget.php?success");       
    }
   
    // Close the connection
      $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="resetpass.css">
</head>

<body>
    <!-- Create the fixed navbar -->
    <div class="Navigation">
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="image\nitte-nmamit-logo.png" alt="">
            </a>
        </nav>
    </div>
    <!-- Create the form -->
    <div class="simple-form bgstyle" align="center">
        <h4></h4>
        <div class="container">
            <div>
                <img src="image\user-1633249__480.webp" alt=".." class="user">
            </div>
            <form class="mtop" action="resetpass.php" method="POST">
                <div class="form-group">
                    <label for="email" class="mleft">Email Id:</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label for="secret" class="secretleft">Hint:</label>
                    <input type="password" id="secret" name="secret" class="form-control" placeholder="Enter the hint" required>
                </div>
                <?php
                 // display the error message is dsta entered is wrong
                if($log_err == true){
                   echo"<span id='demo'style='color:red;font-weight:bold;margin-left:-85px;margin-top:-3%';>Email or the secret word entered is wrong</span>";}  
               ?>
                <div>
                <button type="submit" name="Submit" class="btn send">Next</button>
                </div>    
                <a href="index.php" class="back">Back to login</a>
            </form>
        </div>   
              
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
</body>

</html>