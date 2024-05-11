<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) 
{
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "applicationForm"; 
    $conn = mysqli_connect($server, $username, $password, $database);
    if (!$conn) 
    {
        die("Connection failed: " . mysqli_connect_error());
    }
    $email = $_SESSION['email'];
    if(isset($_POST['current_password'], $_POST['new_password'], $_POST['confirm_password'])) 
    {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        $sql = "SELECT PASSWORD FROM `registered_data` WHERE `EMAIL` = '$email'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) 
        {
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row['PASSWORD'];
            if ($current_password === $stored_password) 
            {
                if ($new_password === $confirm_password) 
                {
                    $update_sql = "UPDATE `registered_data` SET PASSWORD = '$new_password' WHERE `EMAIL` = '$email'";
                    if (mysqli_query($conn, $update_sql)) 
                    {
                        echo "Successfully updated the password";
                    } else 
                    {
                        echo "Error: Wait, updating password " . mysqli_error($conn);
                    }
                } 
                else 
                {
                    echo "Confirm password and new password does not match!";
                }
            } 
            else 
            {
                echo "Current password is not correct!";
            }
        } 
        else 
        {
            echo "User id not found!";
        }
    } 
    else 
    {
        echo "Every fields are required!";
    }

    mysqli_close($conn);
} 
else 
{
    header("Location: welcome.php");
    exit();
}
?>
