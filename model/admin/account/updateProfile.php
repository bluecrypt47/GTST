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

    public function update($idUser, $name, $phoneNumber, $avatarName, $updateAt)
    {
        $avatarName = basename($_FILES['avatar']['name']);
        $checkTypeImg = ['jpg', 'jpeg', 'png', 'gif'];
        $fileType = strtolower(pathinfo($avatarName, PATHINFO_EXTENSION));

        $hashAvatarName = md5(strtotime(date('Y-m-d H:i:s'))) . "." . $fileType;
        $avatarPath = "../../assets/img/avatar/" . $hashAvatarName;
        move_uploaded_file($_FILES["avatar"]["tmp_name"], $avatarPath);


        $name = $this->format->validate($name);
        $phoneNumber = $this->format->validate($phoneNumber);
        $hashAvatarName = $this->format->validate($hashAvatarName);

        $name = mysqli_real_escape_string($this->db->link, $name);
        $phoneNumber = mysqli_real_escape_string($this->db->link, $phoneNumber);

        if (!in_array($fileType, $checkTypeImg)) {
            $msg = "<span class='text-danger'>The File is invalid!</span>";
            return $msg;
        } elseif ($_FILES['avatar']['size'] > 3000000) {
            $msg = "<span class='text-danger'>File size must be less than 3 MB!</span>";
            return $msg;
        }

        if ($phoneNumber != NULL) {
            if (strlen($phoneNumber) < 9 || strlen($phoneNumber) > 10) {
                $msg = "<span class='text-danger'>The phone number must be from 9 to 10 numbers!</span>";
                return $msg;
            } elseif (!filter_var($phoneNumber, FILTER_SANITIZE_NUMBER_INT)) {
                $msg = "<span class='text-danger'>The phone number must be the number!</span>";
                return $msg;
            }



            $query = "UPDATE users SET name='$name', phoneNumber='$phoneNumber', avatar='$hashAvatarName', updateAt='$updateAt' WHERE idUser='$idUser'";
            $result = $this->db->upadte($query);

            if ($result != false) {
                Session::set('name', $name);
                Session::set('avatar', $hashAvatarName);
                Session::set('phoneNumber', $phoneNumber);
            } else {
                $msg = "<span class='text-danger'>Update fail!</span>";
                return $msg;
            }
        } else {
            $query = "UPDATE users SET name='$name', phoneNumber='$phoneNumber', avatar='$hashAvatarName', updateAt='$updateAt' WHERE idUser='$idUser'";
            $result = $this->db->upadte($query);

            if ($result != false) {
                Session::set('name', $name);
                Session::set('avatar', $hashAvatarName);
                Session::set('phoneNumber', $phoneNumber);

                $msg = "<span class='text-success'>Update Successfully!</span>";
                return $msg;
            } else {
                $msg = "<span class='text-danger'>Update fail!</span>";
                return $msg;
            }
        }
    }
}