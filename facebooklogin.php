<?php ob_start(); ?>
<?php require "marketheader.php"?>
<?php

//$_SESSION["uname"] = "lakshmi";
//$_SESSION["uid"] = 50;

//$_SESSION["uid"] = 50;
$fname ="lakshmi";
$lname="priya";
$emailId="lpriya33@gmail.com";
$address="India";
$hphone="9398086316";
$cphone="7656457674";
$uname="lakshmi";
$passwd="abc123";



if ($uname != '' && $passwd != '') {
    $passwd = password_hash($passwd, PASSWORD_DEFAULT);               
    $conn = new mysqli($servername, $username, $password, $dbname);
    $msg= "Connected successfully"; 
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $user="SELECT * from marketplace.user WHERE username='$uname';";
    $userQuery= $conn->query($user)  ; 
    print_r($userQuery);
    if($userQuery->num_rows > 0)
    {       
        $res=$userQuery->fetch_assoc();
        echo  $res["username"];
        echo $res["id"];
        $_SESSION["uname"] = $res["username"];
        $_SESSION["uid"] = $res["id"];   
        require "fbuserstatus.php";  
        // header("location: markethomepage.php");
        // exit();    
        //user exists
       // $submiterr="Username already exists!";
    }              
                     
        //echo  $guid;
        $sql = "INSERT INTO marketplace.user(first_name, last_name, email, address, home_phone, cell_phone, username, password) VALUES  ('$fname', '$lname', '$emailId', '$address', '$hphone', '$cphone', '$uname', '$passwd')";

        if ($conn->query($sql) === TRUE) {
            $sqluser = "SELECT * FROM marketplace.user where username='$uname' and password='$passwd'";
            $sqluserres=$conn->query($sqluser);
            if ($sqluserres->num_rows >0)
            {
                //$data=$sqlproductsres->fetch_assoc();  
                $user=$sqluserres->fetch_assoc();
                $userid=$user["id"];
                $_SESSION["uname"] = $uname;
                $_SESSION["uid"] = $userid;
                require "fbuserstatus.php";
                 //echo "New record created successfully";
                // header("location: markethomepage.php");
                // exit();                          
            }
         } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
    $conn->close();
}

?>