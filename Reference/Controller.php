<?php
class Controller
{
    public function __construct()
    {
    }

    public function View($ViewName = "")
    {
        global $Context;
        $this->Layout = "$Context->WorkingDir/Views/_ViewStart.php";
        if($ViewName == "")
            $Context->ViewName = $Context->ViewName."/".$Context->Controller."/".$Context->Method.".php";
        else
            $Context->ViewName = $Context->ViewName."/".$ViewName;
        if($this->Layout == "")
        {
            require_once FILES_ROOT.$Context->WorkingDir."/_ViewStart.php";
        }
        else{
            require_once FILES_ROOT.$Context->WorkingDir.$this->Layout;
        }
    }

    public function JSON($obj)
    {
        header("Content-Type: application/json");
        echo json_encode($obj);
    }

    public function get_GET($obj)
    {
        $reflect = new ReflectionClass($obj);
        $props = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);
        foreach ($props as $prop) {
            $prop->setValue($obj, $_GET[$prop->getName()]);
        }
        return $obj;
    }

    public function get_POST($obj)
    {
        $reflect = new ReflectionClass($obj);
        $props = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);
        foreach ($props as $prop) {
            $prop->setValue($obj, $_POST[$prop->getName()]);
            //print $prop->getName();
        }
        return $obj; 
    }
}
$ViewData = null;
?>