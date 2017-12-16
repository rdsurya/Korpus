<?php

require "../class/connect.php";

$reply = new stdClass();
$reply->valid = false;
$reply->msg = "Incomplete data";



if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['name']) ) {


    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $name = mysqli_real_escape_string($link, $_POST['name']);

    // check whether username is available or not
    $result = mysqli_query($link, "SELECT username FROM `admin` WHERE `username` ='$username' ");
    
    if (mysqli_num_rows($result) > 0 ) {
        $reply->valid = false;
        $reply->msg = "The username $username is already used. Please enter other username.";
    } else {
        // no data matched
        $sql = "INSERT INTO `admin`(username, password, `name`) VALUES('$username','$password','$name');";



        if (mysqli_query($link, $sql)) {
            $reply->valid = true;
            $reply->msg = "Success adding new admin.";
            
        } else {
            $reply->valid = false;
            $reply->msg = "Something is wrong with the query into table admin. " . mysqli_error($link) . " \n" . $sql;
        }
    }
}
mysqli_close($link);

echo json_encode($reply);
?>
