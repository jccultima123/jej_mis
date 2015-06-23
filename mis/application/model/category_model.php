<?php

class CategoryModel
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
    
    public function getCategories() {
        $sql = "SELECT * FROM categories ORDER BY id ASC";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->fetchAll();
    }

    public function addCategory($category, $SKU, $manufacturer_name, $product_name, $product_model, $price, $link)
    {
        $sql = "INSERT INTO tb_products (category, SKU, manufacturer_name, product_name, product_model, price, link) VALUES (:category, :SKU, :manufacturer_name, :product_name, :product_model, :price, :link)";
        $query = $this->db->prepare($sql);
        $parameters = array(':category' => $category, ':SKU' => $SKU, ':manufacturer_name' => $manufacturer_name, ':product_name' => $product_name, ':product_model' => $product_model, ':price' => $price, ':link' => $link);

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
    
    public function getAmountOfProducts()
    {
        $sql = "SELECT COUNT(product_id) AS amount_of_products FROM tb_products";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_products;
    }
    
    public function getProductbyCategory() {
        $sql = "SELECT categories.name, COUNT(tb_products.product_name) AS count
                FROM `categories`
                LEFT JOIN `tb_products` ON tb_products.category = categories.id
                GROUP BY categories.id;";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->fetchAll();
    }
    
    // **************************************************************************************
    
}
