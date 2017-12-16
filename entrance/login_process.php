<?php
session_start();
require '../class/connect.php';

$username = isset($_POST['username']) ? $_POST['username'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

$reply = new stdClass();
$reply->valid = false;
$reply->msg = "Incomplete data!";

if ($username != null && $password != null) {
    $query = "Select password, name, id from admin where username='$username'";
    $result = mysqli_query($link, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if (strcmp($password, $row['password']) == 0) {
            $reply->valid = true;
            $_SESSION['id']=$row['id'];
            $_SESSION['username']=$username;
            $_SESSION['name']=$row['name'];
        } else {
            $reply->msg = "Wrong password!";
        }
    } else {
        $reply->msg = "Username does not exist!";
    }
}

echo json_encode($reply);
mysqli_close($link);
?>
