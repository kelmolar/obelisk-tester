<?php
use \Facebook\Facebook;
use \Abraham\TwitterOAuth\TwitterOAuth;

function makeFBLoginURL($unique) {
         //facebook login
          $fb = new Facebook([
          'app_id' => FACEBOOK_APP_ID, // Replace {app-id} with your app id
          'app_secret' => FACEBOOK_APP_SECRET,
          'default_graph_version' => FACEBOOK_GRAPH_VERSION
          ]);

        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['publish_actions','email']; // Optional permissions
        $callbackUrl = implode("/", array(
		 BASE_URL, 
		sprintf("FacebookLogin.php?unique=%s", $unique)
	));
        return $helper->getLoginUrl($callbackUrl, $permissions);
}
function makeTwitterLoginURL($unique) {
        //twitter login
        $connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET);
        $callbackUrl = implode("/", array(
		BASE_URL, 
	 	sprintf("TwitterLogin.php?unique=%s", $unique)
	));
        $temporaryCredentials = $connection->oauth('oauth/request_token', array("oauth_callback" => $callbackUrl));
        return $connection->url("oauth/authorize", array("oauth_token" => $temporaryCredentials['oauth_token']));
}

