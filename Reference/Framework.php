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
}

$HTML = new HTMLHelper();
?>