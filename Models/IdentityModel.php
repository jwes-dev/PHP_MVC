<?php
class AccountManager
{
    public function __construct()
    {
        $this->db = NewSQLConnection();
    }

    public function SignUp($email, $password)
    {
        $password =  password_hash($password, PASSWORD_DEFAULT);
        $q = "INSERT INTO Accounts VALUES('$email', '$password')";
        return $this->db->query($q);
    }

    public function AddToRole($email, $role)
    {
        $password =  password_hash($password, PASSWORD_DEFAULT);
        $q = "INSERT INTO UserRoles(Email, Roles) VALUES('$email', '$role') ON DUPLICATE KEY UPDATE    
        Roles = Roles + ',$role'";
        return $this->db->query($q);
    }

    public function ChangePassword($Email)
    {
        $token = $this->GetPasswordChangeToken($Email);
        Email::Send(
            $Email,
            "Passsword Reset",
            "Follow this link to reset your password: http://".APP_ROOT."/AccountManager/ResetPassword?token=$token"
        );
        return TRUE;
    }

    public function GetPasswordChangeToken($Email)
    {
        $Key = password_hash($Email, PASSWORD_DEFAULT);
        $q = "INSERT INTO PassReset VALUES('$Email', '$Key')";
        return $this->db->query($q);
    }

    public function GetKeyEmail($Key)
    {
        $q = "SELECT Email FROM PassReset WHERE EKey = '$Key'";
        $res = $this->db->query($q);
        if($res->num_rows == 1)
        {
            $row = $res->fetch_assoc();
            return $res["Email"];
        }
        else
        {
            return "";
        }
    }

    public function VerifyLink($Key,  $Email)
    {
        $q = "SELECT * FROM PassReset WHERE Email = '$Email' AND EKey = '$Key'";
        $res = $this->db->query($q);
        return $res->num_rows == 1;
    }

    public function StartSession($Email, $Role)
    {
        session_start();
        $_SESSION["User"] = $Email;
        $_SESSION["Role"] = password_hash($Role, PASSWORD_DEFAULT);
    }


    public function LogIn($Email, $password)
    {
        $q = "SELECT * FROM Accounts WHERE Email = '$Email'";
        $res = $this->db->query($q);
        if($res->num_rows > 0)
        {
            $row = $res->fetch_assoc();
            if(password_verify($password, $row["Secret"]))
            {
                session_start();
                $_SESSION["User"] = $row["Email"];
                $q = "SELECT * FROM UserRoles WHERE Email = '$Email'";
                $res = $this->db->query($q);
                $_SESSION["Role"] = password_hash($row["Roles"], PASSWORD_DEFAULT);
                return true;
            }
        }
        return false;
    }
}
?>