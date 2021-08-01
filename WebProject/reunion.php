<?php
   if(isset($_POST['mail'])){
     // include connection.php to this page 
   include("connection.php");
  //  Check the connection
   if (!$conn) {
    die("Connection failed: " . $conn->mysqli_connect_error());
    } 
  
    // Get the data from the form
    $oemail=$_POST['mail'];
    $password=$_POST['password'];
    $batch=$_POST['batch'];
    $date=$_POST['date'];
    $time=$_POST['time'];
    $location=$_POST['location'];
    $state=$_POST['state'];
    $country=$_POST['country'];

    
    $smt = "SELECT * FROM register WHERE email = '$oemail' and pwd ='$password' and batch='$batch'";
    $result=mysqli_query($conn,$smt);
    $row = mysqli_num_rows($result);
    
    // Check whether the email is registered ,if yes organise the reunion
    if($row===1){
        $sqlquery="INSERT INTO `reunion`( `email`, `password`, `batch`, `date`, `time`, `location`, `state`, `country`) VALUES ('$oemail','$password','$batch','$date','$time','$location','$state','$country')";
        
        $sqlexecute=mysqli_query($conn,$sqlquery);
        if(($sqlexecute)===true){
            echo '<script  type="text/JavaScript">
                alert("Organising of the reunion is successful");
                window.location="http://localhost/webProject/home.php";
            </script>';
        }else{
          // Error occured during oraganizing the reunion
          echo '<script  type="text/JavaScript">
          alert("Organising of the reunion was unsuccessful");
          window.location="http://localhost/webProject/home.php";
      </script>';
        }
    }
    else{
          // Data entered is not proper
            echo '<script type="text/JavaScript">  
        alert("Email id or password or batch does not match"); 
        window.location="http://localhost/webProject/home.php";
        </script>';  
    }
    // Close the conncetion
    $conn->close();
  }

 ?>

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Reunion</title>
    <style>
      .form{
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        display:block;
        margin:auto;
        padding:20px;
        border:solid grey 1px;
        margin-top:100px; 
        width:40%;
        background-color: aliceblue; 
        border-radius: 10px;
        }
    </style>
</head>
<body>
    <!-- Add a fixed navbar -->
    <nav class="navbar fixed-top navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="image/nitte-nmamit-logo.png" width="400" height="60" alt="NITTE">
          </a>
        <h1 class="text-center">ORGANISE REUNIONS</h1>
    </nav>
   
    <!-- Form to organise the email -->
    <div class="container-fluid  align-items-center ">
      <div class="form justify-content-center ">
      <form action="home.html" id="myForm" method="POST">
        <div class="form-row">
          <div class="form-group col-sm-6">
            <label for="inputEmail4">Organiser mail-id</label>
            <input type="email"  name="mail" class="form-control" id="inputEmail" required>
          </div>

          <div class="form-group col-sm-6">
            <label for="inputPassword4">Organiser-Password</label>
            <input type="password"  name="password" class="form-control" id="inputPassword4" required>
          </div>
        </div>

        <div class="form-group">
          <label for="inputAddress">Choose your Batch</label>
          <input type="number"  name="batch" class="form-control" id="batch" placeholder="1986" min="1986" required>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputAddress2">Date</label>
                <input type="date"  name="date" class="form-control" id="date"required >
            </div>

            <div class="form-group col-md-6">
                <label for="inputAddress2">Time</label>
                <input type="time"  name="time"class="form-control" id="time" required>
            </div>

            <div class="form-group col-md-12">
                <label for="inputAddress2">Location</label>
                <input type="text" name="location" class="form-control" id="location" placeholder="Meeting hall.."required>
            </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputState">State</label>
            <input name="state"  type="text" class="form-control" id="State" required>
            
          </div>
          <div class="form-group col-md-6">
            <label for="inputCountry">Country</label>
            <input name="country"  type="text" class="form-control" id="Country" required>
            
          </div>
        </div>
        
        <div class="text-center">
          <!-- Call rsvp() fuction on pressing the button -->
            <button type="submit" name="organise" class="btn btn-primary" onclick="rsvp()">Organise</button>
         </div>
      </form>

    </div>
</div>

<!-- Javascript  code for reunion -->
<script src="reunion.js"></script>
    
</body>
</html>

 

