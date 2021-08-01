<?php
    $delete=false;
    // Start the session
     session_start();
    //  include connection.php to this page
     include("connection.php");
    // Check connection
     if (!$conn) {
     die("Connection failed: " . $conn->mysqli_connect_error());
}
    //   Read the session variable
      $email=$_SESSION['email'];
    
    //   Delete the data if user has organized the reunion while terminating the account
      $sql=mysqli_query($conn,"SELECT * FROM reunoin WHERE email='$email'");
      $numrow=mysqli_num_rows($sql);
      if($numrow > 0){
          $result=mysqli_query($conn,"DELETE FROM reunion WHERE email='$email'");
          if($result){
                $delete=true;
          }
          else{
            // Display the error meassage is error occurs while terminating the account
            echo '<script  type="text/JavaScript">
                window.location="http://localhost/webProject/edit.php";
                alert("Error in terminating Your account");
                </script>';
          }
      }
      
      $sql=mysqli_query($conn,"SELECT * FROM alumniimage WHERE email='$email'");
      $row=mysqli_num_rows($sql);
      if($row > 0){
           //   Delete the user image from the table while teminating the account
        $rows=mysqli_query($conn,"DELETE FROM alumniimage WHERE email='$email'");
        if($rows){
            // Delete the user account
            $result=mysqli_query($conn,"DELETE FROM register WHERE email='$email'");
           if($result){
            echo '<script  type="text/JavaScript">
                window.location="http://localhost/webProject/index.php";
                alert("Your account has been terminated");
                </script>';
        }
        else{
            // Display error message if error occurs while terminating the acount
            echo '<script  type="text/JavaScript">
                window.location="http://localhost/webProject/home.php";
                alert("Error in terminating Your account");
                </script>';
         }
       }
        else{
            // Display error message if error occurs during terminating the account
            echo '<script  type="text/JavaScript">
                window.location="http://localhost/webProject/index.php";
                alert("Your account has been terminated");
                </script>';
        }
      }
  else{
    //   Terminate the account if the image is not uploaded
        $result=mysqli_query($conn,"DELETE FROM register WHERE email='$email'");
        if($result){
            echo '<script  type="text/JavaScript">
                window.location="http://localhost/webProject/index.php";
                alert("Your account has been terminated");
                </script>';
        }
        else{
            echo '<script  type="text/JavaScript">
                window.location="http://localhost/webProject/home.php";
                alert("Error in terminating Your account");
                </script>';
        }
    }
  ?>
  