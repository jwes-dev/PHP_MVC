<?php
function RenderSection($name, $required)
{
    $name = "section_".$name;
    if($required)
    {
        if(function_exists($name))
            $name();
        else
            echo "FATAL ERROR: Call to undefuned section: ".$name;
    }
    else{
        if(function_exists($name))
            $name();
    }
}

class HTMLHelper{
    public function ActionLink($LinekText, $Action, $Controller, $htmlAttributes = "")
    {
        echo "<a href=\"".APP_ROOT."$Controller/$Action\" $htmlAttributes>$LinekText</a>\n";
    }

    public function RenderContent($vpath)
    {
        echo APP_ROOT.$vpath;
    }
}

$HTML = new HTMLHelper();

function set_Status_code_result($id, $msg)
{
    $sapi_type = php_sapi_name();
    if (substr($sapi_type, 0, 3) == 'cgi')
        header("Status: $id $msg");
    else
        header("HTTP/1.1 $id $msg");
    exit;
}
?>