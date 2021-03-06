<?php

class InventoryModel
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
        $sql = "SELECT tb_product_line.*,
                tb_products.*,
                categories.name
                FROM `tb_product_line`
                LEFT JOIN `tb_products` on tb_product_line.product = tb_products.product_id
                LEFT JOIN `categories` on tb_products.category = categories.cat_id
                WHERE tb_product_line.branch = :branch_id
                ORDER BY tb_products.brand ASC";
        $query = $this->db->prepare($sql);
        $parameters = array(':branch_id' => $_SESSION['branch_id']);
        $query->execute($parameters);
        
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
    
    public function getCategories() {
        $sql = "SELECT DISTINCT cat_id, name FROM categories WHERE name != 'Undefined' ORDER BY cat_id ASC";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->fetchAll();
    }
    
    public function deleteProduct($product_id)
    {
        $sql = "DELETE FROM tb_product_line WHERE product_id = :product_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':product_id' => $product_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
        $_SESSION["feedback_positive"][] = CRUD_DELETE;
    }
    
    public function getProduct($product_id)
    {
        $sql = "SELECT tb_product_line.*,
                tb_users.*,
                categories.name,
                asset_status.status
                FROM `tb_product_line`
                LEFT JOIN `tb_users` on tb_product_line.added_by = tb_users.user_id
                LEFT JOIN `categories` on tb_product_line.category = categories.cat_id
                LEFT JOIN `asset_status` on tb_product_line.status_id = asset_status.as_id
                WHERE product_id = :product_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':product_id' => $product_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }
    
    public function countProducts()
    {
        $sql = "SELECT COUNT(line_id) AS product_count FROM tb_product_line";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->product_count;
    }
    
    public function getLatestTime() {
        $sql = "SELECT timestamp AS latest_prod_time FROM tb_product_line ORDER BY timestamp DESC LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->latest_prod_time;
    }
    
    // **************************************************************************************
    // REPORTS
    
    public function reportProducts()
    {
        if (isset($_SESSION['admin_logged_in'])) {
            $sql = "SELECT tb_product_line.*,
                    tb_products.*,
                    tb_branch.branch_name,
                    categories.name
                    FROM `tb_product_line`
                    LEFT JOIN `tb_products` on tb_product_line.product = tb_products.product_id
                    LEFT JOIN `tb_branch` on tb_product_line.branch = tb_branch.branch_id
                    LEFT JOIN `categories` on tb_products.category = categories.cat_id
                    ORDER BY tb_products.brand ASC";
            $query = $this->db->prepare($sql);
            $query->execute();
        } else {
            $sql = "SELECT tb_product_line.*,
                    tb_products.*,
                    tb_branch.branch_name,
                    categories.name
                    FROM `tb_product_line`
                    LEFT JOIN `tb_products` on tb_product_line.product = tb_products.product_id
                    LEFT JOIN `tb_branch` on tb_product_line.branch = tb_branch.branch_id
                    LEFT JOIN `categories` on tb_products.category = categories.cat_id
                    WHERE tb_product_line.branch = :branch_id
                    ORDER BY tb_products.brand ASC";
            $query = $this->db->prepare($sql);
            $parameters = array(':branch_id' => $_SESSION['branch_id']);
            $query->execute($parameters);
            $_SESSION["feedback_note"][] = FEEDBACK_PRIV_ISSUE;
        }
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
}
