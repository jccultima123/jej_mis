<?php

class ProductModel
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
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
    
    /**
     * Get all products
     */
    public function getAllProducts()
    {
        $sql = "SELECT tb_products.*,
                categories.name
                FROM `tb_products`
                LEFT JOIN `categories` on tb_products.category = categories.cat_id
                WHERE available = 1
                ORDER BY manufacturer_name ASC";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    public function getSomeProducts($start, $limit)
    {
        $sql = "SELECT tb_products.*,
                categories.name
                FROM `tb_products`
                LEFT JOIN `categories` on tb_products.category = categories.cat_id
                WHERE available = 1
                ORDER BY manufacturer_name ASC
                LIMIT " . $start . ", " . $limit;
        $query = $this->db->prepare($sql);
        $query->execute();
        
        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    
    public function getAllManufacturers()
    {
        $sql = "SELECT DISTINCT manufacturer_name, COUNT(*) as count FROM tb_products GROUP BY manufacturer_name ORDER BY count DESC";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    
    public function getCategories() {
        $sql = "SELECT DISTINCT cat_id, name FROM categories ORDER BY cat_id ASC";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->fetchAll();
    }
    
    public function searchProducts($search) {
        if (!isset($search) OR empty($search)) {
            $_SESSION["feedback_negative"][] = FEEDBACK_ITEM_NOT_AVAILABLE;
            return false;
        } else if (preg_match("/[A-Z  | a-z]+/", $search)) {
            $sql = "SELECT tb_products.*, categories.name FROM tb_products, categories WHERE categories.name = tb_products.category AND tb_products.product_name LIKE '%" . $search . "%' OR tb_products.manufacturer_name LIKE '%" . $search . "%' OR categories.name LIKE '%" . $search . "%'";
            $query = $this->db->prepare($sql);
            $query->execute();
            $fetch = $query->fetchAll();
            return $fetch;
            if (empty($fetch)) {
                $_SESSION["feedback_negative"][] = FEEDBACK_ITEM_NOT_AVAILABLE;
            }
        }
    }

    public function addProduct($added_by, $category, $IMEI, $IMEI_2, $manufacturer_name, $product_name, $product_model, $SRP)
    {
        $sql = "INSERT INTO tb_products (added_by, category, IMEI, IMEI_2, manufacturer_name, product_name, product_model, SRP, timestamp) VALUES (:added_by, :category, :IMEI, :IMEI_2, :manufacturer_name, :product_name, :product_model, :SRP, :timestamp)";
        $query = $this->db->prepare($sql);
        $parameters = array(':added_by' => $added_by,
                            ':category' => $category,
                            ':IMEI' => $IMEI,
                            ':IMEI_2' => $IMEI_2,
                            ':manufacturer_name' => $manufacturer_name,
                            ':product_name' => $product_name,
                            ':product_model' => $product_model,
                            ':SRP' => $SRP,
                            ':timestamp' => time());

        $query->execute($parameters);
        $_SESSION["feedback_positive"][] = CRUD_ADDED;
    }
    
    public function deleteProduct($product_id)
    {
        $sql = "DELETE FROM tb_products WHERE product_id = :product_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':product_id' => $product_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
        $_SESSION["feedback_positive"][] = CRUD_DELETE;
    }
    
    public function getProduct($product_id)
    {
        $sql = "SELECT product_id, category, SKU, manufacturer_name, product_name, product_model, price, link FROM tb_products WHERE product_id = :product_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':product_id' => $product_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }
    
    public function updateProduct($category, $SKU, $manufacturer_name, $product_name, $product_model, $price, $link, $product_id)
    {
        if ($link == "") {
            $link = null;
        }
        
        $sql = "UPDATE tb_products SET category = :category, SKU = :SKU, manufacturer_name = :manufacturer_name, product_name = :product_name, product_model = :product_model, price = :price, link = :link WHERE product_id = :product_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':category' => $category, ':SKU' => $SKU, ':manufacturer_name' => $manufacturer_name, ':product_name' => $product_name, ':product_model' => $product_model, ':price' => $price, ':link' => $link, ':product_id' => $product_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
        $_SESSION["feedback_positive"][] = '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);
    }
    
    public function countProducts()
    {
        $sql = "SELECT COUNT(product_id) AS product_count FROM tb_products";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->product_count;
    }
    
    public function getProductbyCategory() {
        $sql = "SELECT categories.name, COUNT(tb_products.product_name) AS count
                FROM `categories`
                LEFT JOIN `tb_products` ON tb_products.category = categories.cat_id
                GROUP BY categories.cat_id";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->fetchAll();
    }
    
    // **************************************************************************************
    
}
