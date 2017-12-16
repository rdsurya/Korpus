<?php

require "../class/connect.php";

$reply = new stdClass();
$reply->valid = false;
$reply->msg = "Incomplete data";



if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['name'])) {


    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $name = mysqli_real_escape_string($link, $_POST['name']);


    // no data matched
    $sql = "UPDATE `admin` SET `name`='$name', password='$password' WHERE username='$username';";



    if (mysqli_query($link, $sql)) {
        $reply->valid = true;
        $reply->msg = "Success updating admin information.";
    } else {
        $reply->valid = false;
        $reply->msg = "Something is wrong with the query into table admin. " . mysqli_error($link) . " \n" . $sql;
    }
}
mysqli_close($link);

echo json_encode($reply);
?>
