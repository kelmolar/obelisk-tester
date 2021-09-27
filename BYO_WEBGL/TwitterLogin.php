<?
require_once(__DIR__."/config.inc.php");
use \Abraham\TwitterOAuth\TwitterOAuth;
if(!session_id()) {
    session_start();
}
$connection = new TwitterOAuth(TWITTER_CONSUMER_KEY,TWITTER_CONSUMER_SECRET);
try {
        $screenshotPath = implode("/", array(__DIR__, "ScreenShots", $_REQUEST['unique'], "screenshot.jpg"));
	//necessary to get access token other wise u will not have permision to get user info
	$accessToken = $connection->oauth("oauth/access_token", array(
	    "oauth_verifier" => $_REQUEST['oauth_verifier'],
	    "oauth_token" => $_REQUEST['oauth_token']
	));
	//now again create new instance using updated return oauth_token and oauth_token_secret because old one expired if u dont u this u will also get token expired error
	$connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $accessToken['oauth_token'], $accessToken['oauth_token_secret']);
	$media = $connection->upload('media/upload', ['media' => $screenshotPath]);
	$parameters = [
	    'status' => UPDATE_TEXT,
	    'media_ids' => implode(',', array($media->media_id_string))
	];
	$result = $connection->post('statuses/update', $parameters);
} catch (Exception $ex) {
  echo "Could not post to Twitter.";
  exit;
}
?>
<!DOCTYPE HTML>
<html>
   <head>
	<title>Photo Shared on Twitter</title>
   </head>
   <body>
	<h2>The image was shared on twitter</h2>
   </body>
</html>
