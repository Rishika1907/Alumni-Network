function deleteaccount(){
    // Ask whether the user wants to delete the account
    var result=confirm("Do you want to Delete your account?");
    if(result == true){
        var value=confirm("Are you sure! You want to delete your account");
        if(value == true){
            window.location="signout.php";
        }
        else{
            alert("You clicked cancel button");
            window.location="home.php";
        }
    }
    else{
        alert("You clicked cancel button");
        window.location="home.php";
    }
}