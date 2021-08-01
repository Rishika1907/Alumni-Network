<?php
    //starting the session
    session_start();

    $pass_err=false;
    $reset=false;
    if(isset($_POST['Submit'])){
        //include connedtion.php file to this page
        include("connection.php");
     
     // Check connection
     if (!$conn) {
       die("Connection failed: " . $conn->mysqli_connect_error());
     }
    //reading the session variable
    $email=$_SESSION['email'];

    // obtaining the data from the form
    $password=$_POST['password'];
    $confirmpass=$_POST['confirmpassword'];

  // check whether password and confirm password are same or not
    if($password!=$confirmpass){
           $pass_err=true;
    }
    
    //if data entered is valid update the password
    if($pass_err == false){
    $sql=mysqli_query($conn,"UPDATE register SET pwd='$password' WHERE email='$email'");
      if($sql == true){
             $reset=true;
             echo '<script  type="text/JavaScript">
             alert("Password is successfully reset");
             window.location="http://localhost/webProject/index.php";
         </script>';
        }
       else{
        echo '<script  type="text/JavaScript">
        alert("Password  and Confirm Password doesnt match");
        window.location="http://localhost/webProject/frget.php";
    </script>';
       }
    }
    //close the connection
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
    <!-- creating a fixed navbar -->
    <div class="Navigation">
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="image\nitte-nmamit-logo.png" alt="">
            </a>
        </nav>
    </div>
    <!-- creating the form -->
    <div class="simple-form bgstyle" align="center">
        <h4 class="rtop">Reset Password</h4>
        <div class="container">
            <form class="mtop" action="frget.php" method="POST">
                <div class="form-group">
                <label for="password" class="newleft"><b>New Password:</b></label>
                <input type="password" class="form-control" id="password" placeholder="New Password" name="password" required>
                </div>

                <div class="form-group">
                <label for="confirmpassword" class="passleft"><b>Confirm Password:</b></label>
                    <input type="password" class="form-control" placeholder="Confirm Password" id="confirmpassword" name="confirmpassword" required>
                </div>

                <?php
                  //if password and confirm password does not match display the error message
                   if($pass_err == true){
                       echo"<span style='color:red;font-weight:bold;margin-left:-75px';>Password and Confirmpassword doesn't match</span>";
                   }
                ?>

                <div>
                    <button type="submit" name="Submit" class="btn send">Reset</button>
                </div>
            </form>
        </div>  
            
    </div>
</body>
</html>