<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/lib/database.php");
include("$_SERVER[DOCUMENT_ROOT]/GTST/helpers/format.php");



class updateProfile
{

    private $db;
    private $format;

    public function __construct()
    {
        $this->db = new Database();
        $this->format = new Format();
    }

    public function changePassword($idUser, $currentPassword, $newPassword, $retypePassword, $updateAt)
    {
        $currentPassword = md5($this->format->validate($currentPassword));
        $newPassword = $this->format->validate($newPassword);
        $retypePassword = $this->format->validate($retypePassword);

        $uppercase = preg_match('@[A-Z]@', $newPassword);
        $lowercase = preg_match('@[a-z]@', $newPassword);
        $number    = preg_match('@[0-9]@', $newPassword);
        $specialChars = preg_match('@[^\w]@', $newPassword);

        try {

            if ($currentPassword == '' || $newPassword == '') {
                $msg = "<span class='text-danger'>No empty!</span>";
                return $msg;
            }
            if ($currentPassword != Session::get('password')) {
                $msg = "<span class='text-danger'>The current password is not correct!</span>";
                return $msg;
            }

            if ($newPassword != $retypePassword) {
                $msg = "<span class='text-danger'>The retype password not match!</span>";
                return $msg;
            }

            if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($newPassword) < 8) {
                $msg = "<span class='text-danger'>Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character!</span>";
                return $msg;
            } else {
                $newPassword = md5($newPassword);
                $query = "UPDATE users SET password='$newPassword',  updateAt='$updateAt' WHERE idUser='$idUser'";
                $result = $this->db->upadte($query);

                if ($result != false) {
                    session_destroy();
                    echo '<script language="javascript">alert("Change password Successfully!"); window.location="index.php";</script>';
                } else {
                    $msg = "<span class='text-danger'>Change password fail!</span>";
                    return $msg;
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
