<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/lib/database.php");
include("$_SERVER[DOCUMENT_ROOT]/GTST/helpers/format.php");

class products
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
        $query = "SELECT * FROM producttypes ORDER BY idProductType";
        $result = $this->db->select($query);

        return $result;
    }

    public function getAllProduct()
    {
        $query = "SELECT * FROM `products`";
        $result = $this->db->select($query);

        return $result;
    }

    public function getHighlightProduct()
    {
        $query = "SELECT * FROM `products` WHERE highlightProduct = 1 ORDER BY idProduct LIMIT 10";
        $result = $this->db->select($query);

        return $result;
    }

    public function getNewProduct()
    {
        $query = "SELECT * FROM `products` WHERE newProduct = 1 ORDER BY idProduct LIMIT 10";
        $result = $this->db->select($query);

        return $result;
    }

    public function getProductByID($id)
    {
        $query = "SELECT * FROM `products` WHERE idProduct = $id";
        $result = $this->db->select($query);

        return $result;
    }

    public function getRelationProduct($idType)
    {
        $query = "SELECT * FROM `products` WHERE idProductType = $idType ORDER BY idProduct LIMIT 10";
        $result = $this->db->select($query);

        return $result;
    }

    // paginate
    public function countProducts()
    {
        $query = "SELECT count(*) as total FROM products";
        $result = $this->db->select($query);

        return $result;
    }

    public function startEnd($start, $limit)
    {
        $query = "SELECT * FROM products, producttypes WHERE products.idProductType = producttypes.idProductType ORDER BY idProduct LIMIT $start, $limit";
        $result = $this->db->select($query);

        return $result;
    }
}
