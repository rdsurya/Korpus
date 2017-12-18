<?php
require '../../class/connect.php';

$id = $_POST['id'];

$query = "Select content from news where id=$id;";
$result = mysqli_query($link, $query);

if ($result){
    $row = mysqli_fetch_assoc($result);
    $content = $row['content'];
    echo $content;
}

?>

