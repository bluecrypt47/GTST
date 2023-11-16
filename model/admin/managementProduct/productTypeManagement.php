<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/lib/database.php");
include("$_SERVER[DOCUMENT_ROOT]/GTST/helpers/format.php");


class productTypeManagement
{

    private $db;
    private $format;

    public function __construct()
    {
        $this->db = new Database();
        $this->format = new Format();
    }

    public function getListType()
    {
        try {
            $query = "SELECT * FROM producttypes ORDER BY idProductType";
            $result = $this->db->select($query);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function addType($name)
    {

        $name = $this->format->validate($name);

        if ($name == '') {
            $msg = "<span class='text-danger'>No empty!</span>";
            return $msg;
        } else {
            $checkName = "SELECT * FROM `producttypes` WHERE nameProductType = '$name' ";
            $rsCheck = $this->db->select($checkName);

            if ($rsCheck) {
                $msg = "<span class='text-danger'>Name exists!</span>";
                return $msg;
            } else {
                $query = "INSERT INTO `producttypes`(`nameProductType`) VALUES ('$name')";
                $result = $this->db->insert($query);

                if ($result != false) {
                    echo '<script language="javascript">alert("Add Type Successfully!"); window.location="typeList.php";</script>';
                } else {
                    $msg = "<span class='text-danger'>Add Type fail!</span>";
                    return $msg;
                }
            }
        }
    }

    public function typeInfo($typeID)
    {
        try {
            $query = "SELECT * FROM `producttypes` WHERE idProductType  = '$typeID'";
            $result = $this->db->select($query);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function updateType($idProductType, $name, $updateAt)
    {
        try {
            $name = $this->format->validate($name);
            $idProductType = $this->format->validate($idProductType);

            $name = mysqli_real_escape_string($this->db->link, $name);

            if ($name == '') {
                $msg = "<span class='text-danger'>No empty!</span>";
                return $msg;
            } else {
                $query = "UPDATE `producttypes` SET `nameProductType`='$name', `updateAtProType`='$updateAt' WHERE `idProductType`='$idProductType'";
                $result = $this->db->insert($query);

                if ($result != false) {
                    $msg = "<span class='text-success'>Update Type Successfully!</span>";
                    return $msg;
                } else {
                    $msg = "<span class='text-success'>Update Type fail!</span>";
                    return $msg;
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function delType($typeID)
    {
        try {
            $query = "DELETE FROM `producttypes` WHERE idProductType = '$typeID'";
            $result = $this->db->delete($query);

            if ($result != false) {
                $msg = "<span class='text-success'>Delete Type Successfully!</span>";
                return $msg;
            } else {
                $msg = "<span class='text-danger'>Delete Type Successfully!</span>";
                return $msg;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // paginate
    public function countTypes()
    {
        try {
            $query = "SELECT count(*) as total FROM producttypes";
            $result = $this->db->select($query);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function startEnd($start, $limit)
    {
        try {
            $query = "SELECT * FROM producttypes ORDER BY idProductType LIMIT $start, $limit";
            $result = $this->db->select($query);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
