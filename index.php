<!-- 
############################################################
## Coded By Ahmad Zulfi                                   ##
## Date: 06 November 2016                                 ##
## Blog: http://www.codex2015.com                         ##
############################################################
-->
<?php
$clantag = "CLAN TAG DISINI"; // clan tag harus menggunakan tanda '#' contoh #2RUVYCPG
$token = "TOKENNYA DISINI"; // ambil token di https://developer.clashofclans.com
$url = "https://api.clashofclans.com/v1/clans/" . urlencode($clantag);
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
}
$members = $data["memberList"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $data["name"]; ?> | Official site</title>
	<meta content='Offical Website Clan <?php echo $data["name"]; ?>' name='description'/>
	<meta content='Offical Website Clan <?php echo $data["name"]; ?>' name='keywords'/>
	<meta content='Ahmad Zulfi' name='author'/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="codex/coc.css" type="text/css"/>
 <link rel="shortcut icon" href="<?php echo $data["badgeUrls"]["medium"]; ?>">
</head>
<body>
<?php
  if (isset($errormsg)) {
    echo "<p>", "Failed: ", $data["reason"], " : ", isset($data["message"]) ? $data["message"] : "", "</p></body></html>";
    exit;
  }
?>
<div class="container-fluid">
<br><br><br>
<div class="row">
  <div class="col-md-3">
    <div class="thumbnail">
      <img src="<?php echo $data["badgeUrls"]["large"]; ?>" alt="Profil">
      <div class="caption">
      <center><h4>Nama : <?php echo $data["name"]; ?> </h4></center>
      <center>Tag : <?php echo $data["tag"]; ?></center>
      <center>Level : <?php echo $data["clanLevel"]; ?></center>
      <center>Point : <?php echo $data["clanPoints"]; ?></center>
      <center>War Win : <?php echo $data["warWins"]; ?></center>
      <center>War win streak : <?php echo $data["warWinStreak"]; ?></center>
      <center>Wars drawn : <?php echo $data["warTies"]; ?></center>
      <center>Wars lost : <?php echo $data["warLosses"]; ?></center>
      <center>Members : <?php echo $data["members"]; ?>/50</center>
      <center>Type : <?php echo $data["type"]; ?></center>
      <center>Required trophies : <?php echo $data["requiredTrophies"]; ?></center>
      <center>War frequency : <?php echo $data["warFrequency"]; ?></center>
      <center>Clan location : <?php echo $data["location"]["name"]; ?></center>
      </div>
    </div>
</div>
  <div class="col-md-9">
  <div class="alert alert-success" role="alert"><b>Deskripsi</b><br><?php echo $data["description"]; ?></div>
</div>
<div class="col-md-9">
  <ul class="list-group">
  <li class="list-group-item">
    <i class="glyphicon glyphicon-th-list"></i> Clan Members
  </li>
  <?php
  foreach ($members as $member) {
  ?>
  <li class="list-group-item">
    <span class="badge"><?php echo $member["role"]; ?></span>
    <?php echo $member["clanRank"]?>.
    <img src="<?php echo $member["league"]["iconUrls"]["tiny"]; ?>" alt="<?php echo $member["league"]["name"]; ?>"/>  <?php echo "<b>".$member["name"]."</b>"  ?> | Donated: <?php echo $member["donations"]; ?> | Received: <?php echo $member["donationsReceived"]; ?> | Trophy : <b><?php echo $member["trophies"]; ?></b>
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
