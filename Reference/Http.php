<?php
class Response
{
    public static function Redirect($NewUrl)
    {
        header("Location: $NewUrl");
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
}
?>