<?php

require '../class/connect.php';
error_reporting(E_ERROR);

$key = $_POST['key'];
//$key = "Malaysia";
$query = "SELECT title, category, date_format(created_date, '%d-%m-%Y') as tarikh, content FROM news WHERE content like '% $key%';";
$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) > 0) {
    $intWord = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $tolalWord = 0;

        $title = $row['title'];
        $category = $row['category'];
        $tarikh = $row['tarikh'];
        $arrSentence = explode(".", $row['content']);
        $context = "";
        $bil = 0;

        for ($i = 0; $i < sizeof($arrSentence); $i++) {
            $found = false;
            if (stripos($arrSentence[$i], $key) !== false) {
                $par = ""; //str_ireplace($key,"<b>$key</b>",$arrSentence[$i],$j);
//                $tolalWord = $tolalWord+$j;
//                $context .="<p>$par</p>";
                $arrWords = explode(" ", $arrSentence[$i]);

                for ($k = 0; $k < sizeof($arrWords); $k++) {
                    //echo $arrWords[$k] . "<br>";
                    if (strcasecmp($arrWords[$k], $key) == 0) {
                        $par .="<b>$arrWords[$k]</b> ";
                        $tolalWord++;
                        $found = true;
                    } else {
                        $par .="$arrWords[$k] ";
                    }
                }//end for words
                if ($found) {
                    $bil++;
                    $context .="<p>$bil) $par.</p>";
                }
            }
        }//end for sentence

        if (strcasecmp(trim($context), "") != 0) {
            $intWord +=$tolalWord;
            echo "<tr class='text-center'>"
            . "<td>$tarikh</td>"
            . "<td>$title</td>"
            . "<td>$category</td>"
            . "<td>$tolalWord</td>"
            . "<td class='text-left' style='padding:5px;'>$context</td>"
            . "</tr>";
        }
    }//end while
    
    if($intWord < 1){
        echo "<tr><td colspan='5'><center>No result found!</center></td></tr>";
    }
} else {
    echo "<tr><td colspan='5'><center>No result found!</center></td></tr>";
}
mysqli_close($link);
?>

