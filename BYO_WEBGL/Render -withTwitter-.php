<?php
// using opening tag <? vs <?php because jareds godaddy server only recognizes short tags
require_once(__DIR__."/../../config.inc.php");
$unique = basename(dirname(__FILE__));
$uniqueDir = implode("/", array("ScreenShots", $unique));
$screenShotPath = implode("/", array($uniqueDir, "screenshot.jpg"));
$webScreenShotPath = implode("/", array(BASE_URL, $screenShotPath));
$facebookAuthURL = makeFBLoginURL($unique);
//$twitterAuthURL = makeTwitterLoginURL($unique);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>pic</title>
<meta property="og:url" content="<?=$webScreenShotPath;?>" />
<meta property="og:type" content="website" />
<meta property="og:title" content="New Build!" />
<meta property="og:description" content="Check out my custom Movestrong build!" />
<meta property="og:image" content="<?=$webScreenShotPath;?>" />
</head>

<body>
<style>
ul.buttons {
  width: 138px;
  list-style: none;
  margin: 0;
  padding: 0;
}
ul.buttons li {
  float: left;
  margin-right: 5px;
}
ul.buttons:after {
  content: '';
  clear: both;
  display: block;
  margin: 0;
}
</style>
<center>
<img src="<?=$webScreenShotPath?>" alt="Your Custom Build" style="width:1280px;height:720px;"/>
<h3>Share Photo On</h3>
 <ul class="buttons">
   <li>
    <a href="<?=$facebookAuthURL?>">
	<img src="../../img/facebook.png" alt="Facebook" />
    </a>
   </li>
   <li>
    <a href="<?=$twitterAuthURL?>">
	<img src="../../img/twitter.png" alt="Twitter" />
    </a>
   </li>
 </ul>
</center>

</body>
</html>
