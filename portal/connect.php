<?php

$host="localhost";
$user="root";
$pass="";
$db="menteelogin";
$conn=new mysqli($host,$user,$pass,$db);
if($conn->connect_error){
    echo "Failed to connect database".$conn->connect_error;
}
?>