<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/lib/database.php");
include("$_SERVER[DOCUMENT_ROOT]/GTST/helpers/format.php");


class userManagement
{

    private $db;
    private $format;

    public function __construct()
    {
        $this->db = new Database();
        $this->format = new Format();
    }

    public function getListUsers()
    {
        try {
            $query = "SELECT * FROM users, roles WHERE users.idRole = roles.idRole ORDER BY idUser";
            $result = $this->db->select($query);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function addUser($name, $phoneNumber, $email, $idRole, $username, $password, $rePassword)
    {
        $name = $this->format->validate($name);
        $phoneNumber = $this->format->validate($phoneNumber);
        // $email = $this->format->validate($email);
        $idRole = $this->format->validate($idRole);
        $username = $this->format->validate($username);
        $password = $this->format->validate($password);
        $rePassword = $this->format->validate($rePassword);

        try {
            if ($name == '' || $email == '' || $username == '' || $password == '') {
                $msg = "<span class='text-danger'>No empty!</span>";
                return $msg;
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $msg = "<span class='text-danger'>Email not valid!!</span>";
                return $msg;
            } elseif ($password != $rePassword) {
                $msg = "<span class='text-danger'>The retype password not match!</span>";
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

                $uppercase = preg_match('@[A-Z]@', $password);
                $lowercase = preg_match('@[a-z]@', $password);
                $number    = preg_match('@[0-9]@', $password);
                $specialChars = preg_match('@[^\w]@', $password);

                if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
                    $msg = "<span class='text-danger'>Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character!</span>";
                    return $msg;
                } else {
                    $checkUsername = "SELECT * FROM `users` WHERE username = '$username' OR email = '$email'";
                    $rsCheck = $this->db->select($checkUsername);

                    if ($rsCheck) {
                        $msg = "<span class='text-danger'>Username or Email exists!</span>";
                        return $msg;
                    } else {
                        $password = md5($password);
                        $query = "INSERT INTO users(`idRole`, `name`, `email`, `phoneNumber`, `username`, `password`) VALUES ('$idRole','$name','$email','$phoneNumber','$username','$password')";
                        $result = $this->db->insert($query);

                        if ($result != false) {

                            echo '<script language="javascript">alert("Add User Successfully!"); window.location="userList.php";</script>';
                        } else {
                            $msg = "<span class='text-danger'>Add user fail!</span>";
                            return $msg;
                        }
                    }
                }
            } else {
                $uppercase = preg_match('@[A-Z]@', $password);
                $lowercase = preg_match('@[a-z]@', $password);
                $number = preg_match('@[0-9]@', $password);
                $specialChars = preg_match('@[^\w]@', $password);

                if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
                    $msg = "<span class='text-danger'>Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character!</span>";
                    return $msg;
                } else {
                    $checkUsername = "SELECT * FROM `users` WHERE username = '$username' OR email = '$email'";
                    $rsCheck = $this->db->select($checkUsername);

                    if ($rsCheck) {
                        $msg = "<span class='text-danger'>Username or Email exists!</span>";
                        return $msg;
                    } else {
                        $password = md5($password);
                        $query = "INSERT INTO users(`idRole`, `name`, `email`, `phoneNumber`, `username`, `password`) VALUES ('$idRole','$name','$email','$phoneNumber','$username','$password')";
                        $result = $this->db->insert($query);

                        if ($result != false) {

                            echo '<script language="javascript">alert("Add User Successfully!"); window.location="userList.php";</script>';
                        } else {
                            $msg = "<span class='text-danger'>Add user fail!</span>";
                            return $msg;
                        }
                    }
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function userInfo($userID)
    {
        try {
            $query = "SELECT * FROM `users` WHERE idUser = '$userID'";
            $result = $this->db->select($query);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // public function updateUserAvatar($userID, $avatarName, $updateAt)
    // {
    //     $fileType = strtolower(pathinfo($avatarName, PATHINFO_EXTENSION));
    //     $hashAvatarName = md5(strtotime(date('Y-m-d H:i:s'))) . "." . $fileType;
    //     $avatarPath = "../../assets/img/avatar/" . $hashAvatarName;
    //     move_uploaded_file($_FILES["avatar"]["tmp_name"], $avatarPath);


    //     $queryEdit = "UPDATE `users` SET `avatar`='$hashAvatarName',`updateAt`='$updateAt' WHERE `idUser`='$userID'";
    //     $result = $this->db->insert($queryEdit);

    //     if ($result != false) {
    //         $msg = "<span class='text-success'>Update avatar user Successfully!</span>";
    //         return $msg;
    //     } else {
    //         $msg = "<span class='text-success'>Update avatar user fail!</span>";
    //         return $msg;
    //     }
    // }

    public function updateUserInfo($userID, $name, $phoneNumber, $idRole,  $updateAt)
    {
        $name = $this->format->validate($name);
        $phoneNumber = $this->format->validate($phoneNumber);
        $idRole = $this->format->validate($idRole);

        $name = mysqli_real_escape_string($this->db->link, $name);
        $phoneNumber = mysqli_real_escape_string($this->db->link, $phoneNumber);

        try {
            if ($phoneNumber != NULL) {
                if (strlen($phoneNumber) < 9 || strlen($phoneNumber) > 10) {
                    $msg = "<span class='text-danger'>The phone number must be from 9 to 10 numbers!</span>";
                    return $msg;
                } elseif (!filter_var($phoneNumber, FILTER_SANITIZE_NUMBER_INT)) {
                    $msg = "<span class='text-danger'>The phone number must be the number!</span>";
                    return $msg;
                }

                $queryEdit = "UPDATE `users` SET `name`='$name',`phoneNumber`='$phoneNumber',`idRole`= '$idRole', `updateAt`='$updateAt' WHERE `idUser`='$userID'";
                $result = $this->db->insert($queryEdit);

                if ($result != false) {
                    $msg = "<span class='text-success'>Update user Successfully!</span>";
                    return $msg;
                } else {
                    $msg = "<span class='text-success'>Update user fail!</span>";
                    return $msg;
                }
            } else {
                $queryEdit = "UPDATE `users` SET `name`='$name',`idRole`= '$idRole', `updateAt`='$updateAt' WHERE `idUser`='$userID'";
                $result = $this->db->insert($queryEdit);

                if ($result != false) {
                    $msg = "<span class='text-success'>Update info user Successfully!</span>";
                    return $msg;
                } else {
                    $msg = "<span class='text-success'>Update info user fail!</span>";
                    return $msg;
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function changePasswordUser($userID, $newPassword, $rePassword, $updateAt)
    {
        $newPassword = $this->format->validate($newPassword);
        $rePassword = $this->format->validate($rePassword);

        $uppercase = preg_match('@[A-Z]@', $newPassword);
        $lowercase = preg_match('@[a-z]@', $newPassword);
        $number    = preg_match('@[0-9]@', $newPassword);
        $specialChars = preg_match('@[^\w]@', $newPassword);

        try {
            if ($newPassword == '') {
                $msg = "<span class='text-danger'>No empty!</span>";
                return $msg;
            }

            if ($newPassword != $rePassword) {
                $msg = "<span class='text-danger'>The retype password not match!</span>";
                return $msg;
            }


            if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($newPassword) < 8) {
                $msg = "<span class='text-danger'>Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character!</span>";
                return $msg;
            } else {
                $newPassword = md5($newPassword);
                $query = "UPDATE users SET password='$newPassword',  updateAt='$updateAt' WHERE idUser='$userID'";
                $result = $this->db->upadte($query);

                if ($result != false) {
                    $msg = "<span class='text-success'>Change password Successfully!</span>";
                    return $msg;
                } else {
                    $msg = "<span class='text-danger'>Change password fail!</span>";
                    return $msg;
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function delUser($userID)
    {
        try {
            $query = "DELETE FROM `users` WHERE idUser = '$userID'";
            $result = $this->db->delete($query);

            if ($result != false) {
                $msg = "<span class='text-success'>Delete User Successfully!</span>";
                return $msg;
            } else {
                $msg = "<span class='text-danger'>Delete User Successfully!</span>";
                return $msg;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getListRole()
    {
        try {
            $query = "SELECT * FROM `roles`";
            $result = $this->db->select($query);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // paginate
    public function countUsers()
    {
        try {
            $query = "SELECT count(*) as total FROM users";
            $result = $this->db->select($query);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function startEnd($start, $limit)
    {
        try {
            $query = "SELECT * FROM users, roles WHERE users.idRole = roles.idRole ORDER BY idUser LIMIT $start, $limit";
            $result = $this->db->select($query);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
