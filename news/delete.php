<?php

require "../class/connect.php";

$reply = new stdClass();
$reply->valid = false;
$reply->msg = "Incomplete data";

if (isset($_POST['id'])) {


    $id = $_POST['id'];

    $query = "DELETE FROM news WHERE id=$id;";
    if (mysqli_query($link, $query)) {
        $reply->valid = true;
        $reply->msg = "News is deleted!";
    } else {
        $reply->valid = false;
        $reply->msg = "Error :" + mysqli_error($link);
    }
}
mysqli_close($link);

echo json_encode($reply);
?>
