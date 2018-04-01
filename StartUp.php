<?php
require_once "global.php";

// REFERENCE
require_once "Reference/Controller.php";
require_once "Reference/Context.php";
require_once "Reference/Framework.php";

// APP_START
require_once "App_Start/BundlesConfig.php";

// Controllers
require_once "Controllers/HomeController.php";

$Context = new RequestContext();

if(isset($_GET["mvc_path"]))
    $Context->URL = strtok($_GET["mvc_path"],'?');
else
    $Context->URL = "";


$path_sec = explode('/', $Context->URL);
$Context->Controller = $path_sec[0];
$CName = $Context->Controller."Controller";
$Context->Method = $path_sec[1];
$MName = $path_sec[1];
$Controller = new $CName;
$Controller->$MName();
?>