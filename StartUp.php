<?php
// REFERENCE
require_once "Reference/Controller.php";
require_once "Reference/Context.php";
require_once "Reference/Framework.php";
require_once "Reference/Http.php";
require_once "Reference/Auth.php";

// APP_START
require_once "App_Start/BundlesConfig.php";
require_once "App_Start/RouteConfig.php";
require_once "App_Start/AppConfig.php";

//External Libraries
require_once "Reference/Mailer/PHPMailerAutoload.php";

// App Library
require_once "global.php";
require_once "Models/IdentityModel.php";

// Controllers
// require_once "Controllers/HomeController.php";

$Context = new RequestContext();

if(isset($_GET["mvc_path"]))
    $Context->URL = strtok($_GET["mvc_path"],'?');
else
    $Context->URL = ROUTES["/"];

$path_sec = explode('/', $Context->URL);
$Context->Controller = $path_sec[sizeof($path_sec) - 2];
$CName = $Context->Controller."Controller";
$MName = $path_sec[sizeof($path_sec) - 1];
$Context->Method = $MName;


$path_sec[sizeof($path_sec) - 2] = "{controller}";
$path_sec[sizeof($path_sec) - 1] = "{action}";
$p = implode("/", $path_sec);
$temp = R_TEMPLATES[$p];
$temp = str_replace("{controller}", $CName.".php", $temp);
$temp = str_replace("/{action}", "", $temp);
if(file_exists(FILES_ROOT."/".$temp))
{
    require_once $temp;
    if(sizeof($path_sec) == 2)
        $Context->WorkingDir = "";
    else
        $Context->WorkingDir = "/".str_replace("/Controllers/$CName.php", "", $temp);
    $Controller = new $CName();
    if(method_exists($Controller, $MName))
    {
        
        $Context->WorkingDir = "";
        $Controller->$MName();
        exit;
    }
    else
    {
        Response::SetStatusCodeResult(404, "Not Found");
        exit;
    }
}
Response::SetStatusCodeResult(404, "Not Found");
exit;
?>