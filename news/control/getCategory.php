<?php
require '../../class/connect.php';

$query = "Select category from category order by category;";
$result = mysqli_query($link, $query);

while ($row = mysqli_fetch_assoc($result)){
    $name = $row['category'];
    echo "<option value='$name'>$name</option>";
}

?>

