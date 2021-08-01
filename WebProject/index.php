<?php
//start the session
session_start();
$log_err=false;
  if(isset($_POST['Login'])){
    //Add the connection.php page to this file
    include("connection.php");
     
  //Check connection
    if (!$conn) {
      die("Connection failed: " . $conn->mysqli_connect_error());
    }
   //Get the email and password from the form
    $email=$_POST['email'];
    $password=$_POST['psw'];
  
    //Write the session variable 
    $_SESSION['email']=$email;
   
    //Check whether the email is registered and password entered is correct
    $result = mysqli_query($conn,"SELECT * FROM register WHERE email = '$email' and pwd ='$password'");
    $row = mysqli_num_rows($result);

    if($row > 0){
          
      header("location:home.php?success");        }
     else{
      $log_err=true;
      echo '<script  type="text/JavaScript">
        alert("Error in Email or Password");
         window.location="http://localhost/webProject/index.php";
        </script>';
        }
        //Close the connection
        $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nmamit Alumni</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="mainpage.css">
  <link rel="icon" href="image\download.png">
</head>

<body>
  <!-- Add the fixed navbar -->
  <div class="Navigation">
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">
        <img src="image\nitte-nmamit-logo.png" alt="">
      </a>
      <h1 style="color: navy; text-align:justify">NMAMIT ALUMNI</h1>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- add the nav element -->
      <div class="collapse justify-content-end navbar-collapse" id="navbarSupportedContent">
        <ul class="nav justify-content-end">
          <li class="nav-item">
            <!-- Display the model on pressing the login -->
            <a class="nav-link active" onclick="document.getElementById('id01').style.display='block'" href="#" >Login</a>
          </li>
          <!-- Open the reistration page on pressing the register -->
          <li class="nav-item">
            <a class="nav-link" href="http://localhost/WebProject/register.php">Register</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>

  <!-- Add the carousel -->
  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel"
    style="position:absolute; margin-top: 100px; width: 100%;">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    </ol>

    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="image\IMG_20201003_171644.JPG" class="d-block w-100" alt="..." height="650px">
        <div class="carousel-caption d-none d-md-block">
          <h1 style="font-size:75px; padding-bottom:150px;">JOIN THE ALUMNI COMMUNITY</h1>
        </div>
      </div>

      <div class="carousel-item">
        <img src="image\Screenshot (59).png" class="d-block w-100" alt="..." height="650px">
        <div class="carousel-caption d-none d-md-block">
          <h1 style="font-size:75px; padding-bottom:150px;">CONNECT WITH NMAMIT </h1>
        </div>
    </div>


    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  
  <!-- Code for Login model -->
  <div id="id01" class="modal">
    
    <form class="modal-content animate" action="index.php" method="POST">
      <div class="imgcontainer">
        <!-- Close the model  -->
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
        <!-- Display the default image -->
        <img src="image\img_avatar2.png" alt="Avatar" class="avatar">
      </div>
      
      <!-- Body of the model -->
      <div class="container">
        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="email" required>
  
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>
          
        <button type="submit" onclick="document.getElementById('id01').style.display='block'" name="Login">Login</button>
        <label>
          <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>
      </div>
       
    <!-- Close the model on pressing Cancel button -->
      <div class="container" style="background-color:#f1f1f1">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        <!-- Open the rest.php page  -->
        <span class="psw"> <a href="resetpass.php">Forgot password?</a></span>
      </div>
    </form>
  </div>
  
  <script>
  // Get the modal
 var modal = document.getElementById('id01');
  
  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
      if (event.target == modal) {
          modal.style.display = "none";
      }
  }
</script>


  <div class="footer">
    <div class="item address">
      <h3 style="margin-left: 30px;">CONTACT US</h3>
      <address style="margin-left: 30px;">
        NMAM Institute of Technology<br>
        Nitte, Karkala Taluk,<br>
        Udupi - 574110<br>
        Karnataka, India
      </address>
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