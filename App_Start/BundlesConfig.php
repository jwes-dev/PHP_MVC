<?php
function RenderScript($src)
{
    echo "<script src=\"".APP_ROOT."Scripts/".$src.".js\" ></script>\n";
}

function RenderStyle($src)
{
    echo "<link href=\"".APP_ROOT."Content/".$src.".css\" rel=\"stylesheet\" />\n";
}
?>