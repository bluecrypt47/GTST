<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/lib/database.php");
include("$_SERVER[DOCUMENT_ROOT]/GTST/helpers/format.php");


class productManagement
{

    private $db;
    private $format;

    public function __construct()
    {
        $this->db = new Database();
        $this->format = new Format();
    }

    public function getListProduct()
    {
        try {
            $query = "SELECT * FROM products ORDER BY idProduct";
            $result = $this->db->select($query);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function addProduct($idProductType, $name, $image, $description, $price, $quantity, $unit)
    {
        $idProductType = $this->format->validate($idProductType);
        $name = $this->format->validate($name);
        $description = $this->format->validate($description);
        $price = $this->format->validate($price);
        $quantity = $this->format->validate($quantity);
        $unit = $this->format->validate($unit);

        $fileType = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $hashImage = md5(strtotime(date('Y-m-d H:i:s'))) . "." . $fileType;
        $imagePath = "../../assets/img/product/" . $hashImage;
        move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
        try {
            if ($name == '') {
                $msg = "<span class='text-danger'>No empty!</span>";
                return $msg;
            } else {
                $checkName = "SELECT * FROM `products` WHERE nameProduct = '$name' ";
                $rsCheck = $this->db->select($checkName);

                if ($rsCheck) {
                    $msg = "<span class='text-danger'>Name product exists!</span>";
                    return $msg;
                } else {
                    $query = "INSERT INTO `products`(`idProductType`, `nameProduct`, `image`, `description`, `price`, `quantity`, `unit`) VALUES ('$idProductType', '$name', '$hashImage', '$description', '$price', '$quantity', '$unit')";
                    $result = $this->db->insert($query);

                    if ($result != false) {
                        echo '<script language="javascript">alert("Add Product Successfully!"); window.location="productList.php";</script>';
                    } else {
                        $msg = "<span class='text-danger'>Add product fail!</span>";
                        return $msg;
                    }
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function productInfo($productID)
    {
        try {
            $query = "SELECT * FROM `products` WHERE idProduct  = '$productID'";
            $result = $this->db->select($query);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // public function updateProduct($productID, $idProductType, $name, $image, $description, $price, $quantity, $unit, $newProduct, $highlightProduct, $updateAt)
    public function updateProduct($productID, $idProductType, $name, $image, $description, $price, $quantity, $unit, $updateAt)
    {
        $idProductType = $this->format->validate($idProductType);
        $name = $this->format->validate($name);
        $image = $this->format->validate($image);
        $description = $this->format->validate($description);
        $price = $this->format->validate($price);
        $quantity = $this->format->validate($quantity);
        $unit = $this->format->validate($unit);
        // $newProduct = $this->format->validate($newProduct);
        // $highlightProduct = $this->format->validate($highlightProduct);

        $fileType = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $hashImage = md5(strtotime(date('Y-m-d H:i:s'))) . "." . $fileType;
        $imagePath = "../../assets/img/product/" . $hashImage;
        move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);

        $name = mysqli_real_escape_string($this->db->link, $name);

        try {
            if ($name == '') {
                $msg = "<span class='text-danger'>No empty!</span>";
                return $msg;
            } else {
                // $query = "UPDATE `products` SET `idProductType`='$idProductType',`nameProduct`='$name',`image`='$hashImage',`description`='$description',`price`='$price',`quantity`='$quantity',`unit`='$unit',`newProduct`='$newProduct',`highlightProduct`='$highlightProduct',`updateAtProduct`='$updateAt' WHERE `idProduct`='$productID'";
                $query = "UPDATE `products` SET `idProductType`='$idProductType',`nameProduct`='$name',`image`='$hashImage',`description`='$description',`price`='$price',`quantity`='$quantity',`unit`='$unit',`updateAtProduct`='$updateAt' WHERE `idProduct`='$productID'";
                $result = $this->db->insert($query);

                if ($result != false) {
                    $msg = "<span class='text-success'>Update product Successfully!</span>";
                    return $msg;
                } else {
                    $msg = "<span class='text-success'>Update product fail!</span>";
                    return $msg;
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function delProduct($productID)
    {
        try {
            $query = "DELETE FROM `products` WHERE idProduct = '$productID'";
            $result = $this->db->delete($query);

            if ($result != false) {
                $msg = "<span class='text-success'>Delete product Successfully!</span>";
                return $msg;
            } else {
                $msg = "<span class='text-danger'>Delete product Successfully!</span>";
                return $msg;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getListType()
    {
        try {
            $query = "SELECT * FROM `producttypes`";
            $result = $this->db->select($query);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // paginate
    public function countProducts()
    {
        try {
            $query = "SELECT count(*) as total FROM products";
            $result = $this->db->select($query);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function startEnd($start, $limit)
    {
        try {
            $query = "SELECT * FROM products, producttypes WHERE products.idProductType = producttypes.idProductType ORDER BY idProduct LIMIT $start, $limit";
            $result = $this->db->select($query);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
