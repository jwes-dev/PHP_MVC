<?php
define("APP_ROOT", "/PHP_MVC");
define("FILES_ROOT", $_SERVER["DOCUMENT_ROOT"]."/PHP_MVC");

define("DB_SERVER", "localhost");
define("DB_SECRET", "");
define("DB_USER", "root");
define("DB_NAME", "PHPMVC");


class Server
{
    public static function MapPath($path, $data = null)
    {
        $query = "";
        if($data != null)
        {
            $query = "?";
            $ds = get_object_vars($data);
            foreach($ds as $v => $val)
            {
                $query += "$v=$val&";
            }
            $query = substr($query, 0, strlen($query) - 2);
        }
        if(substr($path, 0, 2) == "~/" && strlen($path) == 2)
            return APP_ROOT."/?$query";
        else if(substr($path, 0, 2) == "~/")
            return APP_ROOT."/".substr($path, 2)."?$query";
        else
            return $Context->WorkingDir."/".$path."?$query";
    }    
}

// SQL Connection 
function NewSQLConnection()
{
    $conn = new mysqli(DB_SERVER, DB_USER, DB_SECRET, DB_NAME);
    // Check connection
    if ($conn->connect_error) {
        Response::SetResponseStatesCode(500, "Internal Server Error");
    }
    else{
        return $conn;
    }
}
?>