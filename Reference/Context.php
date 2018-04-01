<?php
class RequestContext{
    public function __construct()
    {
        $this->Controller = "";
        $this->Method = "";
        $this->URL = "";
        $this->ViewName = FILES_ROOT."Views/";
        $this->Title = "";
    }
}
?>