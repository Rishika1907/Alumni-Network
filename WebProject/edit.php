 <?php
  session_start();
   $image_error=true;
   $image_found=true;
  if(isset($_POST['submit']))
  {
      //connection to database
      include("connection.php");
      if(!$conn){
        die("Connection failed: " . $conn->mysqli_connect_error());
      }

      $email = $_SESSION['email'];
    //get the file name of image  to be uploaded
    $img_name = $_FILES['file']['name'];

    //upload file
    if ($img_name!='')
    {
        //get the extension of the image to be uploded
        $ext = pathinfo($img_name, PATHINFO_EXTENSION);
        $allowed = ['png', 'gif', 'jpg', 'jpeg'];
        //check if it is valid image type
        if (in_array($ext, $allowed))
        {
            // read image data into a variable for inserting
            $img_data = addslashes(file_get_contents($_FILES['file']['tmp_name']));
            //if image is already present in database update it 
            $result=mysqli_query($conn,"SELECT * FROM alumniimage WHERE email='$email'");
            $row=mysqli_num_rows($result); 
            if($row >0){
                $sql=mysqli_query($conn,"UPDATE alumniimage SET imagea='$img_data' WHERE email='$email'");
                if($sql){
                     $image_error=false;
                }
            }
            // if image is not present in database insert image into the  database
            else{
            $sql = mysqli_query($conn,"INSERT INTO alumniimage(email, imagea) VALUES('$email', '$img_data')");
            if($sql){
                $image_error=false;
            }
            header("Location:edit.php");
            }
        }
        else
        {
            $image_found=false;
        }
    }
    else
        header("Location:edit.php");
    // Close the connection
    $conn->close();
}
?> 

<?php
$pass_error=false;
$success=false;
if(isset($_POST['Submit'])){
    // Add connction.php page to this page
  include("connection.php");
 
 // Check connection
  if (!$conn) {
    die("Connection failed: " . $conn->mysqli_connect_error());
  }
//get the data from the to be updated from the form
    $job=$_POST['job'];
    $secret=$_POST['secret'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $confirmpass=$_POST['confirmpassword'];
    
    //check whether password and confirm password are same
    if($password != $confirmpass){
        $pass_error=true;
        echo "<script>console.log('Debug Objects err: " . $pass_error . "' );</script>";
     }

    //if valid data in entered update the data in database
    if($pass_error == false){
    $result=mysqli_query($conn,"UPDATE register SET job='$job',secre='$secret',phone_no='$phone',pwd='$password' WHERE email='$email'");
    if($result){
        $success=true;
     }
    }
    // Close connection
    $conn->close();
}  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="edit.css">
</head>
<body>
<div class="container">
       <div class="halign">
            <p>Edit Information</p>
        </div>
    <form action="edit.php" method="POST" enctype="multipart/form-data">
        <div >
        <?php
            include("connection.php");
            $email = $_SESSION['email'];
            // fetch image from database
            $result = mysqli_query($conn,"SELECT * FROM alumniimage where email='$email'"); 
            $row = mysqli_fetch_array($result);
            if($row >0){
                //if image is uploded in the database display it 
            echo '<img src="data:image/jpeg;base64,'.base64_encode($row['imagea']).'" alt="Avatar" class="avatar"/>'; 
            }
            else{
                //if image is not uploded in the database display the default image
                echo '<img src="image\img_avatar2.png" alt="Avatar" class="avatar">';
            }
        ?>      
        </div>
        <!-- select the image file to be uploaded -->
         <div style="margin-left:2%;margin-top:3%;">
              <input type="file" name="file"><br>
        </div>

        <div>
            <button type="submit" name="submit" value="submit" class="btn upload">Upload Image</button>
        </div>
        <?php
        // if image is uploded successfully
            if($image_error == false){
                echo "<span id='demo1'style='color:green;font-weight:bold;;margin-left:-25px';><br>Update successful</span>";
            }
        // error occured during uploading the image
            if($image_found == false){
                echo "<span id='demo1'style='color:red;font-weight:bold;margin-left:-25px';><br>Image is not in the required format</span>";
            }
             
           ?>
    </form>

    <form action="edit.php" method="post">
        
                <table class="table_space align">
                    <tr >
                        <td>First name</td>
                        <?php
                        //Add connection.php to this page
                         include("connection.php");
 
                         // Check connection
                        if (!$conn) {
                            die("Connection failed: " . $conn->mysqli_connect_error());
                          }
                        // Read the session variable
                         $email=$_SESSION['email'];
                        // retrevie the data from database and display it in the table
                        $result=mysqli_query($conn,"SELECT * FROM register WHERE email='$email'");
                        $row=mysqli_fetch_array($result);
                       echo "<td><input type='text' class='form-control' name='fname' id='fname' value=" .$row['first_Name']." readonly></td></tr>";
                     
                     echo " <tr>
                        <td>Last name</td>";
                      echo "  <td><input type='text' class='form-control' name='name' id='lname' value=" .$row['last_name']." readonly></td>
                    </tr> ";
                 
                  echo"  <tr>
                        <td>Batch</td>";
                   echo"     <td><input class='form-control' id='batch' name='batch' type='number' value=" .$row['batch']."  readonly></td>
                    </tr>";
                   
                    echo "<tr>
                        <td>Gender</td>";
                     echo "   <td><input type='text' name='gender' id='gender' class='form-control' value=" .$row['gender']." readonly></td>
                    </tr>";
                     
                    echo "<tr>
                        <td>Current Job</td>";
                    echo "  <td><input type='text' name='job' class='form-control' id='job' value=" .$row['job']." ></td>
                    </tr>";

                    echo "<tr>
                        <td>Hint:</td>";
                    echo " <td><input type='text' name='secret' class='form-control' id='secret' value=" .$row['secre']." ><td>
                    </tr>";

                   echo" <tr>
                        <td>Phone no:</td>";
                    echo "<td><input type='tel' pattern='[0-9]{10}' class='form-control' name='phone' id='phone' value=" .$row['phone_no']." ></td>
                    </tr>";
                    
                   echo " <tr>
                        <td>Email:</td>";
                     echo " <td><input type='email' name='email' class='form-control' id='email' value=" .$row['email']." readonly></td>
                    </tr>";
                   
                   echo" <tr>
                        <td>Password:</td>";
                     echo "   <td><input type='password' class='form-control' id='pwd' name='password' value=" .$row['pwd']." ><td>
                    </tr>";

                   echo" <tr>
                        <td>Confirm Password:</td>";
                    echo "  <td><input type='password' class='form-control' id='cnpwd' name='confirmpassword' value=" .$row['pwd']."></td>
                    </tr>";
                    ?>
                  </table>
                <?php
                   //Display the message if data is updated successfully
                    if($pass_error == true){
                        echo"<span id='demo1'style='color:red;font-weight:bold;margin-left:-50px;margin-top:1%';><br>Password and Confirm Password does not match</span>";
                    }
                    //Display error meassge error occured during updating the data
                    if($success == true){
                        echo "<span id='demo1'style='color:green;font-weight:bold;margin-left:-50px';><br>Update successful</span>";
                    }
                ?>
                <div>  
                    <button type="button" class="btn cnl"  onclick="window.location.href='home.php'">Go Back</button>
                    <button id="submit" class="btn styles"  value="Submit" name="Submit" type="submit">Update now</button><br>
                   
                </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
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