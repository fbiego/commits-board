<?php

$Hfiles = array_reverse(glob("*.json"));
$cname = basename(dirname(__FILE__));
$countries = json_decode(file_get_contents("../countries.json"), true);

$Hjson1 = json_decode(file_get_contents($Hfiles[0]), true);
$Hjson2 = json_decode(file_get_contents($Hfiles[1]), true);

function check($cur, $prev){
    if ($prev == NULL){
        return 0;
    } else if ($cur == $prev){
        return 3;
    } else if ($cur < $prev){
        return 1;
    } else {
        return 2;
    }
}
 
 ?>

<!DOCTYPE html>
<html>
   <head>
      <title><?php echo $countries[$cname]; ?></title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="../../css/flx.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <style type="text/css">a {text-decoration:none}</style>
   </head>
   <body>
      <div class="flx-container">
         <div class="flx-github flx-bar flx-xxlarge">
             <a href="../" class="flx-bar-item flx-button "><i class="fa fa-arrow-left flx-margin"></i></a>
        <span class="flx-bar-item"><?php echo $countries[$cname]; ?></span>
        </div>
        
        <ul class="flx-ul flx-card-4">
            <?php
$Hnew = "<i class=\"fa fa-plus-circle flx-text-orange\"></i>";
$Hup = "<i class=\"fa fa-chevron-circle-up flx-text-green\"></i>";
$Hdown = "<i class=\"fa fa-chevron-circle-down flx-text-red\"></i>";
$Hsame = "<i class=\"fa fa-chevron-circle-right flx-text-grey\"></i>";
$Hx = 1;
$Harr = [$Hnew, $Hup, $Hdown, $Hsame];
foreach ($Hjson1 as $Hk=>$Hv)
{

    $Husername = $Hk;
    $Hrank = $Hv ['rank'];
    $Hcommits = $Hv ['commits'];
    $Hicon = $Hv ['icon'];
    $Hname = $Hv ['name'];
    $last = $Hjson2[$Hk]['rank'];
    $Hy = check($Hrank, $last);
    $Hp = "";
    if ($Hx < 10)
    {
        $Hp = "&nbsp;&nbsp;&nbsp;&nbsp;";
    }
    else if ($Hx < 100)
    {
        $Hp = "&nbsp;&nbsp;";
    }
    echo "<a href=\"https://github.com/".$Husername."\"><li class=\"flx-bar flx-hover-github\"><span class=\"flx-bar-item flx-xlarge\">" . $Hp .  $Hrank . "</span>";
    echo "<img src=\"" . $Hicon . "\" class=\"flx-bar-item flx-circle\" style=\"width:85px\">";
    echo "<span class=\"flx-bar-item flx-\">" . $Harr[$Hy] . "</span>";
    echo "<div class=\"flx-bar-item\"><span class=\"flx-\">" . $Husername . "</span><br><span class=\"flx-hide-small\">" . $Hname . "</span></div>";

    echo "<span class=\"flx-bar-item flx-large flx-right flx-hide-small\">" . $Hcommits . "</span></li></a>";
    //echo $Hrank." - ".$Husername." - ".$Hcommits."\n";
    $Hx = $Hx + 1;
}
?>
            
        </ul>

      </div>
      
   </body>
</html>