<?php

class SomModel
{
    public function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            Auth::detectEnvironment();
            $ERROR = "The database was either unable to connect or doesn't exists.<hr /><b>DEBUG:</b> " . $e . "<hr />";
            require_once '_fb/error.html';
            exit();
        }
    }
    
    public function getAllManufacturers()
    {
        $sql = "SELECT DISTINCT tb_som.manufacturer, COUNT(*) as count, tb_manufacturers.manu_name
                FROM tb_som
                LEFT JOIN tb_manufacturers on manufacturer = tb_manufacturers.manu_id
                GROUP BY manufacturer ORDER BY tb_manufacturers.manu_name ASC";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    
    public function getCategories() {
        $sql = "SELECT cat_id, name FROM categories ORDER BY cat_id ASC";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->fetchAll();
    }
    
    public function getStatus()
    {
        $sql = "SELECT * FROM sale_status";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    
    public function getSuppliers()
    {
        $sql = "SELECT * FROM tb_suppliers";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    
    public function getPendingOrders($i)
    {
        $sql = "SELECT COUNT(order_id) AS pending_orders FROM tb_orders WHERE accepted = 0";
        $query = $this->db->prepare($sql);
        $query->execute();
        // fetch() is the PDO method that get exactly one result
        $i = $query->fetch()->pending_orders;
        return $i;
    }
        public function countPendingOrders()
        {
            $sql = "SELECT COUNT(order_id) AS pending_orders FROM tb_orders WHERE accepted = 0";
            $query = $this->db->prepare($sql);
            $query->execute();
            // fetch() is the PDO method that get exactly one result
            return $query->fetch()->pending_orders;        }
    
    public function countSales()
    {
        $sql = "SELECT COUNT(sales_id) AS sales_count FROM tb_salestr";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch()->sales_count;
    }
    
    public function countOrders()
    {
        $sql = "SELECT COUNT(order_id) AS order_count FROM tb_orders";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch()->order_count;
    }
}
