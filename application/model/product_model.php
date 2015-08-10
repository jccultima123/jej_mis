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
                categories.name,
                asset_status.status
                FROM `tb_products`
                LEFT JOIN `categories` on tb_products.category = categories.cat_id
                LEFT JOIN `asset_status` on tb_products.status_id = asset_status.as_id
                ORDER BY brand ASC";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        $fetch = $query->fetchAll();
        if (empty($fetch)) {
            $_SESSION["feedback_negative"][] = FEEDBACK_NO_RECORDS;
            return false;
        } else {
            return $fetch;
        }
    }
    
    public function getAllManufacturers()
    {
        $sql = "SELECT DISTINCT brand, COUNT(*) as count FROM tb_products GROUP BY brand ORDER BY count DESC";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    
    public function getCategories() {
        $sql = "SELECT DISTINCT cat_id, name FROM categories WHERE name != 'Undefined' ORDER BY cat_id ASC";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->fetchAll();
    }

    public function addProduct($category, $brand, $product_name, $description, $DP, $inv, $added_by)
    {
        // check if the product model already exists
        /**
        $q = $this->db->prepare("SELECT * FROM tb_products WHERE product_model = :value");
        $q->execute(array(':value' => $product_model));
        $count =  $q->rowCount();
        if ($count == 1) {
            $_SESSION["feedback_negative"][] = "Product Model already exists." . Auth::detectDBEnv(Helper::debugPDO($sql, $parameters));
            return false;
        }
        **/
        
        $sql = "INSERT INTO tb_products
                (category, brand, product_name, description, DP, inventory_count, added_by, timestamp)
                VALUES (:category, :brand, :product_name, :description, :DP, :inventory_count, :added_by, :timestamp)";
        $query = $this->db->prepare($sql);
        $parameters = array(':category' => $category,
                            ':brand' => strtoupper($brand),
                            ':product_name' => strtoupper($product_name),
                            ':description' => strtoupper($description),
                            ':DP' => $DP,
                            ':inventory_count' => $inv,
                            ':added_by' => $added_by,
                            ':timestamp' => time());

        if ($query->execute($parameters)) {
            $_SESSION["feedback_positive"][] = CRUD_ADDED . Auth::detectDBEnv(Helper::debugPDO($sql, $parameters));
            return true;
        } else {
            $_SESSION["feedback_negative"][] = CRUD_UNABLE_TO_ADD . Auth::detectDBEnv(Helper::debugPDO($sql, $parameters));
        }
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
        $sql = "SELECT tb_products.*,
                tb_users.*,
                categories.name,
                asset_status.status
                FROM `tb_products`
                LEFT JOIN `tb_users` on tb_products.added_by = tb_users.user_id
                LEFT JOIN `categories` on tb_products.category = categories.cat_id
                LEFT JOIN `asset_status` on tb_products.status_id = asset_status.as_id
                WHERE product_id = :product_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':product_id' => $product_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }
    
    public function updateProduct($category, $brand, $product_name, $description, $DP, $inv, $product_id)
    {        
        $sql = "UPDATE tb_products SET category = :category, brand = :brand, product_name = :product_name, description = :description, DP = :DP, inventory_count = :inventory_count, timestamp = :timestamp WHERE product_id = :product_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':category' => $category,
                            ':brand' => $brand,
                            ':product_name' => $product_name,
                            ':description' => $description,
                            ':DP' => $DP,
                            ':inventory_count' => $inv,
                            ':timestamp' => time(),
                            ':product_id' => $product_id);

        $query->execute($parameters);
        $_SESSION["feedback_positive"][] = 'Product #' . $product_id . ' ' . CRUD_UPDATED . '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);
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
    
    public function getLatestTime() {
        $sql = "SELECT timestamp AS latest_prod_time FROM tb_products ORDER BY timestamp DESC LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        $q = $query->fetch();
        if (!empty($q)) {
            return $q->latest_prod_time;
        }
    }
    
    // **************************************************************************************
    
}
