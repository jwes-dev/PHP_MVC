<?php
class Controller
{
    public function __construct()
    {
        $this->Layout = "Views/_ViewStart.php";
    }

    public function SetLayout($Loc)
    {
        $this->Layout = $Loc;
    }

    public function View($ViewName = "")
    {
        global $Context;
        if($ViewName == "")
            $Context->ViewName = $Context->ViewName.$Context->Controller."/".$Context->Method.".php";
        else
            $Context->ViewName = $Context->ViewName.$ViewName;
        if($this->Layout == "")
        {
            require_once FILES_ROOT."_ViewStart.php";
        }
        else{
            require_once FILES_ROOT.$this->Layout;
        }
    }
}
?>