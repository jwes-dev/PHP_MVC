<?php
class Response
{
    public static function Redirect($NewUrl)
    {
        header("Location:".Server::MapPath($NewUrl));
        exit;
    }

    public static function RedirectTo($Controller, $Action, $Query = "")
    {
        if(strlen($Query) == 0)
            header("Location: ".APP_ROOT."$Controller/$Action");
        else
            header("Location: ".APP_ROOT."$Controller/$Action?$Query");
    }

    public static function Write($data)
    {
        echo $data;
    }

    public static function SetHeader($key, $value)
    {
        header("$key:$value");
    }

    public static function SetStatusCodeResult($id, $msg)
    {
        $sapi_type = php_sapi_name();
        if (substr($sapi_type, 0, 3) == 'cgi')
            header("Status: $id $msg");
        else
                header("HTTP/1.1 $id $msg");
        die();
    }

    public static function SetContentType($ctype)
    {
        header("Content-Type:$ctype");
    }
}

class ResponseType
{
    public static function POST($check_var)
    {
        if(!isset($_POST["$check_var"]))
        {
            Response::SetStatusCodeResult(404, "Not Found");
            exit;
        }
    }

    public static function GET($check_var)
    {
        if(!isset($_GET["$check_var"]))
        {
            Response::SetStatusCodeResult(404, "Not Found");
            exit;
        }
    }
}
?>