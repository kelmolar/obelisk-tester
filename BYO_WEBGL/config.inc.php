<?
require_once(__DIR__."/vendor/autoload.php");
require_once(__DIR__."/Helpers.php");
if(!session_id()) {
   session_start();
}

//ini_set("display_errors", "On");
//error_reporting(E_ALL);

// facebook
define("FACEBOOK_APP_ID", "489557727747881");
define("FACEBOOK_APP_SECRET", "0a301381a0c3653821ba56f4bddc7526");
define("FACEBOOK_GRAPH_VERSION", "v2.2");

// twitter
define("TWITTER_CONSUMER_KEY", "8YRjC32XFpQqqGbgsdNpCPAPC");
define("TWITTER_CONSUMER_SECRET", "7nOue20qilDxw7ePOVDgHkccRoVOYcNIh2aQFqIPhgOKmp79LU");

// instagram
define("INSTAGRAM_CLIENT_ID", "");
define("INSTAGRAM_CLIENT_SECRET", "");


// basic information
define("BASE_URL", "http://www.movestrongbyo.com/WebGL/");
define("UPDATE_TEXT", "My custom Movestrong build!");
