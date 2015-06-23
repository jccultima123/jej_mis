<?php

/** FOR SALES **/
class SalesModel
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
    
    public function getAllSales()
    {
        $sql = "SELECT tb_sales.sales_id, tb_sales.category, tb_sales.SKU, tb_sales.manufacturer_name, tb_sales.product_name, tb_sales.product_model, tb_sales.price,
                categories.name
                FROM `tb_sales`
                LEFT JOIN `categories` on tb_sales.category = categories.id
                ORDER BY sales_id ASC";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        $fetch = $query->fetchAll();
        if (empty($fetch)) {
            $_SESSION["feedback_negative"][] = "SALES: " . FEEDBACK_NO_ITEMS;
            return false;
        }
        return $fetch;
    }
    
    public function getAllManufacturers()
    {
        $sql = "SELECT DISTINCT manufacturer_name, COUNT(*) as count FROM tb_sales GROUP BY manufacturer_name ORDER BY count DESC";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    
    public function getCategories() {
        $sql = "SELECT id, name FROM categories ORDER BY id ASC";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->fetchAll();
    }
    
    public function searchSales($search) {
        if (!isset($search) OR empty($search)) {
            $_SESSION["feedback_negative"][] = FEEDBACK_ITEM_NOT_AVAILABLE;
            return false;
        } else if (preg_match("/[A-Z  | a-z]+/", $search)) {
            $sql = "SELECT tb_sales.*, categories.name FROM tb_sales, categories WHERE categories.name = tb_sales.category AND tb_sales.product_name LIKE '%" . $search . "%' OR tb_sales.manufacturer_name LIKE '%" . $search . "%' OR categories.name LIKE '%" . $search . "%'";
            $query = $this->db->prepare($sql);
            $query->execute();
            $fetch = $query->fetchAll();
            return $fetch;
            if (empty($fetch)) {
                $_SESSION["feedback_negative"][] = FEEDBACK_ITEM_NOT_AVAILABLE;
            }
        }
    }

    public function addSales($category, $SKU, $manufacturer_name, $product_name, $product_model, $price)
    {
        $sql = "INSERT INTO tb_sales (category, SKU, manufacturer_name, product_name, product_model, price) VALUES (:category, :SKU, :manufacturer_name, :product_name, :product_model, :price)";
        $query = $this->db->prepare($sql);
        $parameters = array(':category' => $category, ':SKU' => $SKU, ':manufacturer_name' => $manufacturer_name, ':product_name' => $product_name, ':product_model' => $product_model, ':price' => $price);

        $query->execute($parameters);
        $_SESSION["feedback_positive"][] = CRUD_ADDED;
    }
    
    public function deleteSales($sales_id)
    {
        $sql = "DELETE FROM tb_sales WHERE sales_id = :sales_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':sales_id' => $sales_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
        $_SESSION["feedback_positive"][] = CRUD_DELETE;
    }
    
    public function getSales($sales_id)
    {
        $sql = "SELECT * FROM tb_sales JOIN categories WHERE sales_id = :sales_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':sales_id' => $sales_id);

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        $fetch = $query->fetch();
        if ($fetch) {
            return $fetch;
        } else {
            $_SESSION["feedback_negative"][] = 'SALES: ' . CRUD_NOT_FOUND;
        }
    }
    
    public function updateSales($category, $SKU, $manufacturer_name, $product_name, $product_model, $price, $sales_id)
    {   
        $sql = "UPDATE tb_sales SET category = :category, SKU = :SKU, manufacturer_name = :manufacturer_name, product_name = :product_name, product_model = :product_model, price = :price WHERE sales_id = :sales_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':category' => $category, ':SKU' => $SKU, ':manufacturer_name' => $manufacturer_name, ':product_name' => $product_name, ':product_model' => $product_model, ':price' => $price, ':sales_id' => $sales_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        if ($query->execute($parameters)) {
            $_SESSION["feedback_positive"][] = CRUD_UPDATED . Auth::detectDBEnv(Helper::debugPDO($sql, $parameters));
        } else {
            $_SESSION["feedback_negative"][] = CRUD_UNABLE_TO_EDIT . Auth::detectDBEnv(Helper::debugPDO($sql, $parameters));
        }
    }
    
    public function getAmountOfSales()
    {
        $sql = "SELECT COUNT(sales_id) AS amount_of_sales FROM tb_sales";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_sales;
    }
    
    public function getSalesbyCategory() {
        $sql = "SELECT categories.name, COUNT(tb_sales.product_name) AS count
                FROM `categories`
                LEFT JOIN `tb_sales` ON tb_sales.category = categories.id
                GROUP BY categories.id;";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->fetchAll();
    }
    
    // **************************************************************************************
}