<?php
require '../class/connect.php';
error_reporting(E_ERROR);

$key = $_POST['key'];

$query = "SELECT title, category, date_format(created_date, '%d-%m-%Y') as tarikh, content FROM news WHERE content like '% $key%';";
$result = mysqli_query($link, $query);

if(mysqli_num_rows($result)>0){
    
    while($row =  mysqli_fetch_assoc($result)){
        $tolalWord = 0;
        $title = $row['title'];
        $category = $row['category'];
        $tarikh = $row['tarikh'];
        $arrSentence = explode(".", $row['content']);
        $context="";
        
        for($i=0; $i<sizeof($arrSentence); $i++){
            if(stripos($arrSentence[$i], $key) !== false){
                $par = str_ireplace($key,"<b>$key</b>",$arrSentence[$i],$j);
                $tolalWord = $tolalWord+$j;
                $context .="<p>$par</p>";
            }
        }//end for sentence
        
        echo "<tr class='text-center'>"
        . "<td>$tarikh</td>"
        . "<td>$title</td>"
        . "<td>$category</td>"
        . "<td>$tolalWord</td>"
        . "<td class='text-left' style='padding:5px;'>$context</td>"
        . "</tr>";
    }//end while
}
else{
    echo "<tr><td colspan='5'><center>No result found!</center></td></tr>";
}
mysqli_close($link);
?>

