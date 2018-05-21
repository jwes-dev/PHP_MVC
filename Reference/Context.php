<?php
class RequestContext{
    public function __construct()
    {
        session_start();
        $this->Controller = "";
        $this->Method = "";
        $this->URL = "";
        $this->ViewName = FILES_ROOT."/Views/";
        $this->WorkingDir = "";
        $this->Title = "";
        if(isset($_SESSION["User"]))
        {
            $this->Authorised = true;
            $this->Role = $_SESSION["Role"];
            $this->UserName = $_SESSION["User"];
        }
    }
}
?>