<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/lib/database.php");
include("$_SERVER[DOCUMENT_ROOT]/GTST/helpers/format.php");

class carts
{
    private $db;
    private $format;

    public function __construct()
    {
        $this->db = new Database();
        $this->format = new Format();
    }

    public function addToCart($productID, $quantity)
    {
        $productID = $this->format->validate($productID);
        $quantity = $this->format->validate($quantity);

        $queryProduct = "SELECT * FROM `products` WHERE idProduct = $productID";
        $result = $this->db->select($queryProduct)->fetch_assoc();
        echo print_r($result);
    }
}
