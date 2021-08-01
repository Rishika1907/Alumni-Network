function rsvp(){
    // Confirm whether the user wants to organize the reunion
    var value=confirm("Please confirm your reunion");
    // Get the value from the form
    var batch=document.getElementById("batch").value;
    var date=document.getElementById("date").value;
    var loc=document.getElementById("location").value;
    var time=document.getElementById("time").value;
    // Check the value entered is not null
    if(value===true &&(batch!=""&&date!=""&&loc!=""&&time!=""))
    {
        var str="You want to organise the  reunion for the batch ";
        str+=document.getElementById("batch").value+" on ";
        str+=document.getElementById("date").value+","+document.getElementById("time").value+" at ";
        str+=document.getElementById("location").value;
        val=confirm(str);
        if(val===true)
        {
            document.getElementById("myForm").action = "reunion.php";
            
        }else{
            alert("Cancel Button was clicked!!");
            
            window.location="http://localhost/webProject/home.php";
        }
    }
    // Display error message is value entered is null
    else if(batch==""||date==""||loc==""||time==""){
        alert("Null values!!!");
        window.location="http://localhost/webProject/home.php";
    }
    else{
        
        window.location="http://localhost/webProject/home.php";
    }
}