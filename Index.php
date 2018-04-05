<?php
require_once "global.php";

// REFERENCE
require_once "Reference/Controller.php";
require_once "Reference/Context.php";
require_once "Reference/Framework.php";
require_once "Reference/Http.php";

// APP_START
require_once "App_Start/BundlesConfig.php";
require_once "App_Start/RouteConfig.php";

// Controllers
// require_once "Controllers/HomeController.php";

$Context = new RequestContext();

if(isset($_GET["mvc_path"]))
    $Context->URL = strtok($_GET["mvc_path"],'?');
else
    $Context->URL = ROUTES["default"];

$path_sec = explode('/', $Context->URL);
$Context->Controller = $path_sec[0];
$CName = $Context->Controller."Controller";
$Context->Method = $path_sec[1];
$MName = $path_sec[1];

foreach(R_TEMPLATES as $name => $temp)
{
    $temp = str_replace("{controller}", $CName.".php", $temp);
    $temp = str_replace("/{action}", "", $temp);
    if(file_exists(FILES_ROOT.$temp))
    {
        require_once str_replace("/{action}", "", $temp);
        $Controller = new $CName();
        if(method_exists($Controller, $MName))
        {
            $Controller->$MName();
            exit;
        }
        else
            break;
    }        
}
header("Location: ".APP_ROOT."Error/NotFound?msg=".utf8_encode("Error 404: Not Found"))
?>