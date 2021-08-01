<?php
//start the session
session_start();

//include the connection.php file to this page
include("connection.php");
// Check connection
if (!$conn){
  die("Connection failed: " . $conn->mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Bootstrop link for css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <!-- creating the fixed navbar -->
    <div class="nav">
    <nav class="navbar fixed-top  nav">
        <a class="navbar-brand" href="#">
        <img src="image/nitte-nmamit-logo.png" width="350px" height="60px" class=" d-inline-block align-top" alt="" loading="lazy">
        </a>
        <h1 id="heading">NMAMIT ALUMNI</h1>
                <?php
                   //include connection.php page to this file
                    include("connection.php");
                    //check connectiom
                    if (!$conn){
                        die("Connection failed: " . $conn->mysqli_connect_error());
                    }
                    //read the data from the session variable
                    $email = $_SESSION['email'];

                    // fetch image from database
                    $result = mysqli_query($conn,"SELECT * FROM alumniimage where email='$email'"); 
                    $row = mysqli_fetch_array($result);
                    if($row >0){
                        //if image is uploaded by the user display it 
                       echo '<img src="data:image/jpeg;base64,'.base64_encode($row['imagea']).'" alt="profile" height="50px" width="50px" class="im"/>'; 
                    }
                    else{
                        //if image is not uploaded display the default image
                       echo '<img src="image/img_avatar2.png" alt="profile" height="50px" width="50px" class="im" >';
                    }
                ?>
                <!-- logout from thr current session -->
                 <a href="index.php" style="margin-left:96%;">Logout</a>
    </nav>
    </div>

    
    <div class="type" >
        <h2 style=" margin-left:20px;color:white; font-size:60px; margin-top:100px;animation: typing 3.5s steps(30, end); overflow:hidden; white-space:nowrap; ">WELCOME TO THE ALUMNI COMMUNITY.</h2>
    </div>
    
    <!-- Display the upcoming event -->
    <div class="item upcoming">
        <img src="image/illustration-loudspeaker_53876-37218.jpg" alt="upcoming" width="245px" height="150px"style="border-radius:20px">
        <h4>
            Upcoming Events
        </h4>
        <?php
            include("connection.php");
            if (!$conn){
                  die("Connection failed: " . $conn->mysqli_connect_error());
                }
            $result=mysqli_query($conn,"SELECT `date`,`time`,`batch` FROM reunion WHERE `date` > CURDATE() ORDER BY 'date'");
            while($row = mysqli_fetch_assoc($result)){
                echo "Reunion for batch " .$row['batch'] ." on <br/>".$row['date'] ." at ".$row['time'] ."<br/>";
            }
        ?>
    </div>
   
    <!-- Connect with your friends -->
    <div class="item search">
        <h4>
            Find your classmates.Reconnect with them.
        </h4>
        <p>Relive your engineering days.</p>
        <img src="image/seo.png" alt="search" height="100px" style="position: absolute; display: inline;margin-left: 506px; margin-top:-95px;" >  
    </div>

    <!-- Update your profile -->
    <a href="edit.php" style="color:navy;">
        <div class="item update">
            <h4 style="text-align: justify;">Update your profile.</h4>
            <p style="text-align: justify;">Update your position.</p>
            <img src="image/career-progress-concept-illustration_114360-3348.jpg" alt="update" height="100px" style="position: absolute; margin-left:-86px; margin-top: -93px; border-radius: 55%;" >
        </div>
    </a>
    
    <!-- Organize reunion -->
    <div class="reunion">
        <a href="reunion.php" style="color:navy;">
        <h4>
            Reunions.
        </h4>
        <p>Reunite with your batchmates.</p>
        <img src="image/hands-connecting_23-2147506270.jpg" alt="search" height="100px" style="position: absolute; display: inline;margin-left: 506px; margin-top:-95px; border-radius:60%;" >
    </a>
    </div>

    <!-- Delete your account -->
    <div class="terminat">
        <a onclick="deleteaccount()">
           <h4 style="text-align: justify;">
               Delete account.
            </h4>
            <p style="text-align: justify;">Do you wish to delete your account?</p>
            <img src="image\images.png" alt="delete" height="100px" style="position: absolute; display: inline;margin-left: -75px; margin-top:-93px; border-radius:50%;">
        </a>
    </div>

    <!-- Adding footer  -->
    <footer>
        <div class="footer">
            <h3 style="margin-left: 30px;">CONTACT US</h3>
      <address style="margin-left: 30px;">
        NMAM Institute of Technology<br>
        Nitte, Karkala Taluk,<br>
        Udupi - 574110<br>
        Karnataka, India
      </address>
        </div>
    </footer>
    
    <!-- Javscript code for deleting the acount -->
    <script src="signout.js"></script>
    <!-- Bootstrap link -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>