<!-- 
############################################################
## Coded By Ahmad Zulfi                                   ##
## Date: 07 November 2016                                 ##
## Blog: http://www.codex2015.com                         ##
############################################################
-->
<?php
error_reporting(0);
$playertag = $_GET['tag'];
$token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImtpZCI6IjI4YTMxOGY3LTAwMDAtYTFlYi03ZmExLTJjNzQzM2M2Y2NhNSJ9.eyJpc3MiOiJzdXBlcmNlbGwiLCJhdWQiOiJzdXBlcmNlbGw6Z2FtZWFwaSIsImp0aSI6Ijk1NmZmMzhmLTI0MzgtNDYyNi04NTNiLWZjNWVjMDY5MmZlNCIsImlhdCI6MTQ3ODQyOTY4Miwic3ViIjoiZGV2ZWxvcGVyLzYwMTYyYTkyLTVhZDAtYTE2ZS05NGExLWIyODg4ODgyNzI0NCIsInNjb3BlcyI6WyJjbGFzaCJdLCJsaW1pdHMiOlt7InRpZXIiOiJkZXZlbG9wZXIvc2lsdmVyIiwidHlwZSI6InRocm90dGxpbmcifSx7ImNpZHJzIjpbIjM2Ljg1LjI0LjE4NSJdLCJ0eXBlIjoiY2xpZW50In1dfQ.nn_xB63LlHw5yM8pzfq3i7qiUbx_Lvv9QCjikW3EWVcQVPtHlnF_Uekt__43q2wM7eXL1V2FLn0JcCSUrHh2mw"; // ambil token di https://developer.clashofclans.com
$url = "https://api.clashofclans.com/v1/players/" . urlencode($playertag);
$ch = curl_init($url);
$headr = array();
$headr[] = "Accept: application/json";
$headr[] = "Authorization: Bearer ".$token;
curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$res = curl_exec($ch);
$data = json_decode($res, true);
curl_close($ch);
if (isset($data["reason"])) {
  $errormsg = true;
} else if (empty($playertag)) {
	header('location: /');
}
$arch = $data["achievements"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $data["name"]; ?> </title>
	<meta content='<?php echo $data["name"]; ?>' name='description'/>
	<meta content='<?php echo $data["name"]; ?>' name='keywords'/>
	<meta content='Ahmad Zulfi' name='author'/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="codex/coc.css" type="text/css"/>
 <link rel="shortcut icon" href="<?php echo $data["league"]["iconUrls"]["medium"]; ?>">
</head>
<body>
<?php
  if (isset($errormsg)) {
    header('location: /');
    exit;
  }
?>
<div class="container-fluid">
<br><br><br>
<div class="row">
  <div class="col-md-3">
    <div class="thumbnail">
      <img src="<?php echo $data["league"]["iconUrls"]["medium"]; ?>" alt="Profil">
      <div class="caption">
      <center><h4>Nama : <?php echo $data["name"]; ?> </h4></center>
      <center>Tag : <?php echo $data["tag"]; ?></center>
      <center>TH : <?php echo $data["townHallLevel"]; ?></center>
      <center>Exp Level : <?php echo $data["expLevel"]; ?></center>
      <center>Trophy : <?php echo $data["trophies"]; ?></center>
      <center>Best Trophy : <?php echo $data["bestTrophies"]; ?></center>
      <center>Wars Star won : <?php echo $data["warStars"]; ?></center>
      <center>Win : <?php echo $data["attackWins"]; ?></center>
      <center>Defense win : <?php echo $data["defenseWins"]; ?></center>
      <center>Pangkat : <?php echo $data["role"]; ?></center>
      <center>Donate : <?php echo $data["donations"]; ?></center>
      <center>Donate Received : <?php echo $data["donationsReceived"]; ?></center>
      <center>Clan name : <?php echo $data["clan"]["name"]; ?></center>
      </div>
    </div>
</div>
<div class="col-md-9">
  <ul class="list-group">
  <li class="list-group-item">
     Achievements
  </li>
  <?php
  foreach ($arch as $archivment) {
  	$codex = $archivment["stars"];
  ?>
  <li class="list-group-item">
    <?php echo $archivment["name"]?>.
    <br>
    	<?php
    	error_reporting(0); 
    	if ($codex == "1") {
    		$star = '<i class="glyphicon glyphicon-star"></i>';
    	} else if ($codex == "2") {
    		$star = '<i class="glyphicon glyphicon-star"></i> <i class="glyphicon glyphicon-star"></i>';
    	} else if ($codex == "3") {
    		$star = '<i class="glyphicon glyphicon-star"></i> <i class="glyphicon glyphicon-star"></i> <i class="glyphicon glyphicon-star"></i>';
    	} else {
    		$star = '<i class="glyphicon glyphicon-star-empty"></i>';
    	}
    	echo $star;
    	?>
    	<br>
    	<?php echo $archivment["info"]?>.
    	<br>
    	<?php echo $archivment["completionInfo"]?>
    <br>
  </li>
  <?php
  }
?>
</ul>
</div>
</div>
</div>
<br><br><br><br><br><br><br>
</body>
</html>