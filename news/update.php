<?php

require "../class/connect.php";

$reply = new stdClass();
$reply->valid = false;
$reply->msg = "Incomplete data";



if (isset($_POST['title']) && isset($_POST['category']) && isset($_POST['content'])) {


    $title = mysqli_real_escape_string($link, $_POST['title']);
    $category = mysqli_real_escape_string($link, $_POST['category']);
    $content = mysqli_real_escape_string($link, $_POST['content']);
    $id = $_POST['id'];


    // no data matched
    $sql = "UPDATE news SET title='$title', category='$category', content='$content' where id=$id;";



    if (mysqli_query($link, $sql)) {
        $reply->valid = true;
        $reply->msg = "Success updating news information.";
    } else {
        $reply->valid = false;
        $reply->msg = "Something is wrong with the query into table news. " . mysqli_error($link) . " \n" . $sql;
    }
}
mysqli_close($link);

echo json_encode($reply);
?>
