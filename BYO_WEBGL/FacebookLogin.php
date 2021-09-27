<?
require_once(__DIR__."/config.inc.php");
use \Facebook\Facebook;
if(!session_id()) {
    session_start();
}

$fb = new Facebook([
  'app_id' => FACEBOOK_APP_ID, // Replace {app-id} with your app id
  'app_secret' => FACEBOOK_APP_SECRET,
  'default_graph_version' => FACEBOOK_GRAPH_VERSION
  ]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
  $screenshotPath = implode("/", array(__DIR__, "ScreenShots", $_REQUEST['unique'], "screenshot.jpg"));
  $data = [
      'message' => UPDATE_TEXT,
      'source' => $fb->fileToUpload($screenshotPath)
  ];
  $response = $fb->post('/me/photos', $data, $accessToken->getValue());

} catch (\Exception $ex) {
  echo "Could not post to Facebook.";    
  exit;
}
?>
<!DOCTYPE HTML>
<html>
   <head>
	<title>Photo Shared on Facebook</title>
   </head>
   <body>
	<h2>The image was shared on facebook</h2>
   </body>
</html>
