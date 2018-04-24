<?php
    define("ROUTES", array(
        "/" => "Home/Index",
        "MyApi" => "MyApi/Home/Index"
    ));
    define("R_TEMPLATES", array(
        "{controller}/{action}" => "Controllers/{controller}/{action}",
        "MyApi/{controller}/{action}" => "Area/StudentApi/Controllers/{controller}/{action}"
    ));
?>