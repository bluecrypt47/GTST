<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/lib/database.php");
include("$_SERVER[DOCUMENT_ROOT]/GTST/helpers/format.php");


class roleManagement
{

    private $db;
    private $format;

    public function __construct()
    {
        $this->db = new Database();
        $this->format = new Format();
    }

    public function getListRoles()
    {
        try {
            $query = "SELECT * FROM roles ORDER BY idRole";
            $result = $this->db->select($query);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function addRole($name)
    {
        $name = $this->format->validate($name);
        try {
            if ($name == '') {
                $msg = "<span class='text-danger'>No empty!</span>";
                return $msg;
            } else {
                $checkName = "SELECT * FROM `roles` WHERE nameRole = '$name' ";
                $rsCheck = $this->db->select($checkName);

                if ($rsCheck) {
                    $msg = "<span class='text-danger'>Name exists!</span>";
                    return $msg;
                } else {
                    $query = "INSERT INTO `roles`(`nameRole`) VALUES ('$name')";
                    $result = $this->db->insert($query);

                    if ($result != false) {
                        echo '<script language="javascript">alert("Add Role Successfully!"); window.location="roleList.php";</script>';
                    } else {
                        $msg = "<span class='text-danger'>Add role fail!</span>";
                        return $msg;
                    }
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function roleInfo($userID)
    {
        try {
            $query = "SELECT * FROM `roles` WHERE idRole = '$userID'";
            $result = $this->db->select($query);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function updateRole($idRole, $name, $updateAt)
    {
        $name = $this->format->validate($name);
        $idRole = $this->format->validate($idRole);

        $name = mysqli_real_escape_string($this->db->link, $name);

        try {
            if ($name == '') {
                $msg = "<span class='text-danger'>No empty!</span>";
                return $msg;
            } else {
                $query = "UPDATE `roles` SET `nameRole`='$name', `updateAtRole`='$updateAt' WHERE `idRole`='$idRole'";
                $result = $this->db->insert($query);

                if ($result != false) {
                    $msg = "<span class='text-success'>Update role Successfully!</span>";
                    return $msg;
                } else {
                    $msg = "<span class='text-success'>Update role fail!</span>";
                    return $msg;
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function delUser($roleID)
    {
        try {
            $query = "DELETE FROM `roles` WHERE idRole = '$roleID'";
            $result = $this->db->delete($query);

            if ($result != false) {
                $msg = "<span class='text-success'>Delete Role Successfully!</span>";
                return $msg;
            } else {
                $msg = "<span class='text-danger'>Delete Role Successfully!</span>";
                return $msg;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // paginate
    public function countRoles()
    {
        try {
            $query = "SELECT count(*) as total FROM roles";
            $result = $this->db->select($query);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function startEnd($start, $limit)
    {
        try {
            $query = "SELECT * FROM roles ORDER BY idRole LIMIT $start, $limit";
            $result = $this->db->select($query);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
