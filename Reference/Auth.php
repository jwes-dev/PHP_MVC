<?php
class Auth
{
    public function AllowRoles($rs, $onError = "/AccountManager/Login")
    {
        $r = explode(",", $rs);
        foreach($r as $role)
        {
            if(password_verify($role, $rs))
                return;
        }
        Response::Redirect("$onError");
    }
}
?> 