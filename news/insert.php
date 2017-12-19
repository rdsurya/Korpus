<?php
session_start();
require "../class/connect.php";

$reply = new stdClass();
$reply->valid = false;
$reply->msg = "Incomplete data";

$username = $_SESSION['username'];

if (isset($_POST['title']) && isset($_POST['category']) && isset($_POST['content'])) {


    $title = mysqli_real_escape_string($link, $_POST['title']);
    $category = mysqli_real_escape_string($link, $_POST['category']);
    $content = mysqli_real_escape_string($link, $_POST['content']);


    $sql = "INSERT INTO news(title, category, content, created_date, created_by) VALUES('$title','$category','$content', now(), '$username');";

    if (mysqli_query($link, $sql)) {
        $reply->valid = true;
        $reply->msg = "Success adding new news.";
    } else {
        $reply->valid = false;
        $reply->msg = "Something is wrong with the query into table news. " . mysqli_error($link) . " \n" . $sql;
    }
}
mysqli_close($link);

echo json_encode($reply);
?>
