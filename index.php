<?php


$countries = json_decode(file_get_contents("countries.json"), true);


 
 ?>

<!DOCTYPE html>
<html>
   <head>
      <title>Commits Board</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="../css/flx.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <style type="text/css">a {text-decoration:none}</style>
   </head>
   <body>
      <div class="flx-container">
         <div class="flx-github flx-bar flx-xxlarge">
        <span class="flx-bar-item">Commits Board</span>
        </div>
        
        <ul class="flx-ul flx-hoverable flx-xxlarge">
<?php
foreach ($countries as $i=>$j)
{

    echo "<a href=\"./".$i."\"><li class=\"flx-hover-github flx-xlarge  flx-card-4 flx-margin-bottom\"><span class=\"\">" . $j. "</span></li></a>";
}
?>
            
        </ul>

      </div>
      
   </body>
</html>