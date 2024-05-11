<?php
    $severname = "localhost";
    $username = "root";
    $password = "";
    $database = "applicationForm";
    $conn = mysqli_connect($severname , $username , $password , $database );
    if( !$conn ) 
    {
        die("can't able to connect : " . mysqli_connect_error() );
    }
    else 
    {
        echo "You are successfully connected<br>";
    }
?>