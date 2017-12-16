<?php
session_start();
require "../class/connect.php";

$reply = new stdClass();
$reply->valid = false;
$reply->msg = "Incomplete data";
$user = $_SESSION['username'];


if (isset($_POST['username'])) {


    $username = mysqli_real_escape_string($link, $_POST['username']);
    
    if(strcmp($user, $username)==0){
        $reply->valid = false;
        $reply->msg = "You cannot delete your own ID!";    
    }
    else{
        $query = "Select * from `admin`;";
        $result = mysqli_query($link, $query);
        
        if(mysqli_num_rows($result)<2){
            $reply->valid = false;
            $reply->msg = "You cannot delete the admin because currently there are only one admin left!";   
        }
        else{
            $query = "DELETE FROM `admin` WHERE username='$username';";
            if(mysqli_query($link, $query)){
                 $reply->valid = true;
                $reply->msg = "Admin is deleted!";   
            }
            else{
                $reply->valid = false;
                $reply->msg = "Error :"+  mysqli_error($link);   
            }
        }
    }   
   
}
mysqli_close($link);

echo json_encode($reply);
?>
