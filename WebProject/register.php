<?php
$register=false;
$display_error=false;
$pass_error=false;

if(isset($_POST['Submit'])){
    //Include the connection.php page to this page
   include("connection.php");

  // Check connection
if (!$conn) {
  die("Connection failed: " . $conn->mysqli_connect_error());
}

//Get the data from the form
    $firstName=$_POST['fname'];
    $lastName=$_POST['lname'];
    $batch=$_POST['batch'];
    $gender=$_POST['gender'];
    $job=$_POST['job'];
    $secret=$_POST['secret'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $confirmpass=$_POST['confirmpassword'];
    
    //Check whether password and confirm password match
     if($password != $confirmpass){
        $pass_error=true;
     }
    

    $result = mysqli_query($conn,"SELECT * FROM register WHERE email = '$email'");
    $row = mysqli_num_rows($result);
    //Check whether the Email is already registred
    if($row >0){
        $display_error=true;
    }
    else{
        //If email is not registered and data entred is proper ,register it
        if($display_error == false and $pass_error == false){
           $sql=mysqli_query($conn,"INSERT INTO `register` ( `first_Name`, `last_name`, `batch`, `gender`, `job`, `secre`,`phone_no`, `email`, `pwd`, `registeredTime`) VALUES ('$firstName', '$lastName', '$batch', '$gender', '$job','$secret', '$phone', '$email', '$password', current_timestamp())");
            if(($sql)==true){
                 $register=true;
                 header("location:index.php?success");
               }
            else{
                 echo "Error $sql   $conn->error";
               }    
         }
        }
    //Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Registration form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="registration.css" /> 
</head>
<body>
    <!-- Create the fixed navbar -->
    <div class="simple-form bg" align="center">
        <img src="image\nitte-nmamit-logo.png" width="400px" height="75px">
        <h2>Alumni registration form</h2>
       
        <!-- Create the form -->
        <div class="container" >
            <form class="alig" action="register.php" method="POST">
                <div class=" form-inline">
                    <label for="fname">First name:</label>
                    <input type="text" class="form-control" name="fname" id="fname" placeholder="First name" required>
        
                    <label for="lname" class="mleft">Last name:<span class="space1"></label>
                    <input type="text" class="form-control" name="lname" id="lname" placeholder="Last name" required>
                </div>

                <div class=" form-inline">
                    <label for="batch">Batch:</label>
                    <input class="form-control" id="batch" name="batch" type="number" min="1986"; max="2020"; requried>

                    <label style="margin-left:77px;">Gender:</label>
                    <input type="radio" value="Female" name="gender" id="Female" required>
                    <label for="Female">Female</label>
                    <input type="radio" value="Male" name="gender" id="Male" required>
                    <label for="Male">Male</label>
                </div>

                <div class=" form-inline">
                    <label for="job" style="margin-right:4%;">Current Job:</label>
                    <input type="text" name="job" class="form-control" id="job" placeholder="Current Job" required>

                    <label for="secret" class="mleft">Hint:<span class="space1"></label>
                    <input type="password" name="secret" class="form-control" id="secret" placeholder="Enter hint" required>
                </div>

                <div class=" form-inline">
                    <label for="phone">Phone no:</label>
                    <input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone no" pattern="[0-9]{10}" required>

                    <label for="email" class="mleft">Email:<span class="space"></span></label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" required/>
                </div>

                <div class="form-inline">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="pwd" name="password" placeholder="Password" required>

                    <label for="conpwd" class="mleft">Confirm Password:<span class="space2"></label>
                    <input type="password" class="form-control" id="cnpwd" name="confirmpassword" placeholder="Confirm Password" required>
                </div>
                <?php

                    // Display the error message is email ia already registred
                     if($display_error == true){
                         echo"<span id='demo'style='color:red;font-weight:bold;margin-left:-130px';>This email already exixts</span>";
                        }

                    // Dispaly the error message if password and confirm password does not match
                     if($pass_error == true){
                         echo"<span id='demo1'style='color:red;font-weight:bold;margin-left:-25px';><br>Password and Confirm Password does not match</span>";
                     }
                ?>
                     
                <div>  
                    <button type="button" class="btn cnl" onmousedown="showred(this)" onclick="window.location.href='index.php'">Cancel</button>
                    <button id="submit" class="btn styles" onmousedown="showgreen(this)" value="Submit" name="Submit" type="submit">Register now</button><br> 
                </div>
            </form>
        </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script type="text/javascript" src="registration.js"></script>
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

