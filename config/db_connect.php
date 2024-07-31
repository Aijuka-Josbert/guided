<?php
$conn = mysqli_connect('localhost','Josbert','josbert003.','pizza');
//check the connection
if(!$conn){
    echo "connection error: " . mysqli_connect_error();
}

?>