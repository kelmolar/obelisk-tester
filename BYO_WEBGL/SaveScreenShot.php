<?
// using opening tag <? vs <?php because jareds godaddy server only recognizes short tags
require_once(__DIR__."/config.inc.php");

use \Facebook\Facebook;
//use \Abraham\TwitterOAuth\TwitterOAuth;
if(!session_id()) {
    session_start();
}

try {
    $picData = $_POST['picData'];
    $data = base64_decode($picData);

    if (!$data)
    {
	throw new Exception("Could not decode BASE64");
    }
    $finfo = finfo_open(FILEINFO_MIME);
    $mime = finfo_buffer($finfo, $data);
    $imageType = explode(";", $mime)[ 0 ];
    if ($imageType!="image/jpeg") 
    {
	throw new Exception("File MIME is not image/jpeg");
    }

    $dateTime = str_replace(array(" ", ":"), "_", date('Md Y G:i:s'));
    $unique = $dateTime . "_" . bin2hex(random_bytes(20));
    //$unique = uniqid(TRUE);
    //$uniqueDir = implode("/", array("ScreenShots", $unique));
    //make unique directory for this user's share
    $dirParts = explode('/', __DIR__);
    array_pop($dirParts);
    array_push($dirParts, "ScreenShots", $unique);
    $newDir = implode("/", $dirParts);
    mkdir($newDir, 0755, TRUE);
    //mkdir(implode("/", array(__DIR__, $uniqueDir)));
    //mkdir(implode("/", array("/../", $uniqueDir)));
    //create a web and file path for the screenshot
    
    $screenShotPath = implode("/", $dirParts) . "/" . "screenshot.jpg";
    file_put_contents($screenShotPath, $data);
    //$screenShotPath = implode("/", array($uniqueDir, "screenshot.jpg"));
    //file_put_contents(implode("/", array(__DIR__, $screenShotPath)), $data);
    //file_put_contents(implode("/", array("/../", $screenShotPath)), $data);
    $baseURL = "http://" . $_SERVER['SERVER_NAME'];
    $fullURLParts = array($baseURL, "ScreenShots", $unique);
    $webScreenShotPath = implode("/", $fullURLParts) . "/" ."screenshot.jpg";
    //$webScreenShotPath = implode("/", array(BASE_URL, $screenShotPath));
    //$facebookAuthURL = makeFBLoginURL($unique);
    //$twitterAuthURL = makeTwitterLoginURL($unique);
    
    //render the HTML contents and save
    $phpContent = file_get_contents(implode("/", array(__DIR__, "Render.php")));
    //$renderPath = implode("/", array($uniqueDir, "render.php"));
    $renderPath = implode("/", $dirParts) . "/" . "Render.php";
    file_put_contents($renderPath, $phpContent);
    //file_put_contents(implode("/", array(__DIR__, $renderPath)), $phpContent);
    
    //$webScreenShotPath = implode("/", array(BASE_URL, $screenShotPath));
    $webRenderPath = implode("/", $fullURLParts) . "/" ."Render.php";
    //output full web path to the rendered file
    http_response_code(201); //created
    echo $webRenderPath;
} catch (Exception $ex) {
    //echo "Unable to save screenshot";
    echo $ex;
}
?>
