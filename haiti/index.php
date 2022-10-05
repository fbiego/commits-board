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

<!doctype html>
<html lang="en">
  <head>
  	<title><?php echo $countries[$cname]; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../../css/flx.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h1 class="heading-section"><a href="../" ><i class="fa fa-arrow-left"></></i></a> <b> <?php echo $countries[$cname]; ?></b></h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table table-responsive-xl">
						  <tbody>
						  
						             <?php
$Hnew = "<i class=\"fa fa-plus-circle flx-text-orange\" style=\"font-size: 24px;\"></i>";
$Hup = "<i class=\"fa fa-chevron-circle-up flx-text-green\" style=\"font-size: 24px;\"></i>";
$Hdown = "<i class=\"fa fa-chevron-circle-down flx-text-red\" style=\"font-size: 24px;\"></i>";
$Hsame = "<i class=\"fa fa-chevron-circle-right flx-text-grey\" style=\"font-size: 24px;\"></i>";
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
    // echo "<a href=\"https://github.com/".$Husername."\"><li class=\"flx-bar flx-hover-github\"><span class=\"flx-bar-item flx-xlarge\">" . $Hp .  $Hrank . "</span>";
    // echo "<img src=\"" . $Hicon . "\" class=\"flx-bar-item flx-circle\" style=\"width:85px\">";
    // echo "<span class=\"flx-bar-item flx-\">" . $Harr[$Hy] . "</span>";
    // echo "<div class=\"flx-bar-item\"><span class=\"flx-\">" . $Husername . "</span><br><span class=\"flx-hide-small\">" . $Hname . "</span></div>";

    // echo "<span class=\"flx-bar-item flx-large flx-right flx-hide-small\">" . $Hcommits . "</span></li></a>";
    // //echo $Hrank." - ".$Husername." - ".$Hcommits."\n";
	
	
	?> 
						    <tr class="alert" role="alert">
						    	<td><h4><?php echo $Hp . $Hrank; ?></h4></td>
						      <td class="d-flex align-items-center">
						      	<div class="img" style="background-image: url(<?php echo $Hicon; ?>);"></div>
						      	<div class="pl-3 email">
						      		<span><?php echo $Hname; ?></span>
						      		<span><?php echo $Husername; ?></span>
						      	</div>
						      </td>
							  <td>
						      	<?php echo $Harr[$Hy]; ?>
				        	</td>
						      <td><h4><?php echo $Hcommits; ?></h4></td>
						    </tr>
							
								<?php
    $Hx = $Hx + 1;
}
?>
						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>
