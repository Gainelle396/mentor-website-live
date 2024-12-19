<?php

include 'connect.php';

if(isset($_POST['signUp'])){
    $firstName=$_POST['fName'];
    $lastName=$_POST['lName'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);

     //Error handling
     $checkEmail="SELECT * From users where email='$email";
     $result=$conn->query($checkEmail);
     if($result->num_rows>0){
        echo "Email address already taken";
     }
     else{
        $insertQuery="INSERT INTO users(firstName,lastName,email,password)
                       VALUES ('$firstName','$lastName','$email','$password')";
            if($conn->query($insertQuery)==TRUE){
                header("location: portal.html");
            }
            else{
                echo "Error".$conn->error;
            }
     }
}

if(isset($_POST['login'])){
    $email=$_POST['email'];
    $password=$_POSt['password'];
    $password=md5($password);

    $sql="SELECT * FROM users WHERE email='$email' and password='$password'";
    $result=$conn->query($sql);
    if($result->num_rows>0){
     session_start();
     $row=$result->fetch_assoc();
     $_SESSION['email']=$row['email'];
     header("Location: ../index.html");
     exit();
    }
    else{
        echo "Not found, incorrect email or password";
    }
}
?>