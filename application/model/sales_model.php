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
    
    public function getAllSales($start, $limit)
    {
        if (isset($_SESSION['admin_logged_in'])) {
            $sql = "SELECT tb_salestr.*,
                    tb_users.*,
                    tb_branch.branch_name,
                    tb_products.*,
                    tb_customers.*
                    FROM `tb_salestr`
                    LEFT JOIN tb_products on tb_salestr.product_id = tb_products.product_id
                    LEFT JOIN tb_branch on tb_salestr.branch = tb_branch.branch_id
                    LEFT JOIN tb_users on tb_salestr.added_by = tb_users.user_id
                    LEFT JOIN tb_customers on tb_salestr.customer_id = tb_customers.customer_id
                    ORDER BY created DESC
                    LIMIT " . $start . ", " . $limit;
            $query = $this->db->prepare($sql);
            $query->execute();
        } else {
            $branch_id = $_SESSION['branch_id'];
            $sql = "SELECT tb_salestr.*,
                    tb_users.*,
                    tb_branch.branch_name,
                    tb_products.*,
                    tb_customers.*
                    FROM `tb_salestr`
                    LEFT JOIN tb_products on tb_salestr.product_id = tb_products.product_id
                    LEFT JOIN tb_branch on tb_salestr.branch = tb_branch.branch_id
                    LEFT JOIN tb_users on tb_salestr.added_by = tb_users.user_id
                    LEFT JOIN tb_customers on tb_salestr.customer_id = tb_customers.customer_id
                    WHERE tb_salestr.branch = :branch_id
                    ORDER BY created DESC
                    LIMIT " . $start . ", " . $limit;
            $query = $this->db->prepare($sql);
            $parameters = array(':branch_id' => $branch_id);
            $query->execute($parameters);
        }
        
        $fetch = $query->fetchAll();
        if (empty($fetch)) {
            $_SESSION["feedback_negative"][] = FEEDBACK_NO_ITEMS;
            return false;
        } else {
            return $fetch;
        }
    }
    
    public function getAllManufacturers()
    {
        $sql = "SELECT DISTINCT tb_salestr.manufacturer, COUNT(*) as count, tb_manufacturers.manu_name
                FROM tb_salestr
                LEFT JOIN tb_manufacturers on manufacturer = tb_manufacturers.id
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
            $sql = "SELECT tb_salestr.*, categories.name FROM tb_salestr, categories WHERE categories.name = tb_salestr.category AND tb_salestr.product_name LIKE '%" . $search . "%' OR tb_salestr.manufacturer LIKE '%" . $search . "%' OR categories.name LIKE '%" . $search . "%'";
            $query = $this->db->prepare($sql);
            $query->execute();
            $fetch = $query->fetchAll();
            if (empty($fetch)) {
                $_SESSION["feedback_negative"][] = FEEDBACK_ITEM_NOT_AVAILABLE;
            } else {
                return $fetch;
            }
        }
    }

    public function addSales($added_by, $branch, $product_id, $qty, $price, $customer_id) {
        $sql = "INSERT INTO tb_salestr (added_by, branch, product_id, qty, price, created, customer_id) VALUES (:added_by, :branch, :product_id, :qty, :price, :created, :customer_id)";
        $query = $this->db->prepare($sql);
        $parameters = array(':added_by' => $added_by,
            ':branch' => $branch,
            ':product_id' => $product_id,
            ':qty' => $qty,
            ':price' => $price,
            ':created' => time(),
            ':customer_id' => $customer_id);
        if ($query->execute($parameters)) {
            $_SESSION["feedback_positive"][] = CRUD_ADDED . Auth::detectDBEnv(Helper::debugPDO($sql, $parameters));
            return true;
        } else {
            $_SESSION["feedback_negative"][] = CRUD_UNABLE_TO_ADD . Auth::detectDBEnv(Helper::debugPDO($sql, $parameters));
            header('location: ' . PREVIOUS_PAGE);
        }
    }

    public function deleteSales($sales_id)
    {
        $sql = "DELETE FROM tb_salestr WHERE sales_id = :sales_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':sales_id' => $sales_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
        $_SESSION["feedback_positive"][] = CRUD_DELETE;
    }
    
    public function getSales($sales_id)
    {
        if (isset($_SESSION['admin_logged_in'])) {
            $sql = "SELECT tb_salestr.*,
                    tb_users.*,
                    tb_branch.branch_name,
                    tb_products.*,
                    tb_customers.*
                    FROM `tb_salestr`
                    LEFT JOIN tb_products on tb_salestr.product_id = tb_products.product_id
                    LEFT JOIN tb_branch on tb_salestr.branch = tb_branch.branch_id
                    LEFT JOIN tb_users on tb_salestr.added_by = tb_users.user_id
                    LEFT JOIN tb_customers on tb_salestr.customer_id = tb_customers.customer_id
                    WHERE tb_salestr.sales_id = :sales_id";
            $query = $this->db->prepare($sql);
            $parameters = array(':sales_id' => $sales_id);
            $query->execute($parameters);
        } else {
            $branch_id = $_SESSION['branch_id'];
            $sql = "SELECT tb_salestr.*,
                    tb_users.*,
                    tb_branch.branch_name,
                    tb_products.*,
                    tb_customers.*
                    FROM `tb_salestr`
                    LEFT JOIN tb_products on tb_salestr.product_id = tb_products.product_id
                    LEFT JOIN tb_branch on tb_salestr.branch = tb_branch.branch_id
                    LEFT JOIN tb_users on tb_salestr.added_by = tb_users.user_id
                    LEFT JOIN tb_customers on tb_salestr.customer_id = tb_customers.customer_id
                    WHERE tb_salestr.sales_id = :sales_id AND tb_salestr.branch = :branch_id";
            $query = $this->db->prepare($sql);
            $parameters = array(':sales_id' => $sales_id, ':branch_id' => $branch_id);
            $query->execute($parameters);
        }

        // fetch() is the PDO method that get exactly one result
        $fetch = $query->fetch();
        if ($fetch) {
            return $fetch;
        } else {
            $_SESSION["feedback_negative"][] = CRUD_NOT_FOUND;
        }
    }
    
    public function updateSales($product_id, $qty, $price, $customer_id, $sales_id)
    {   
        $sql = "UPDATE tb_salestr
                SET product_id = :product_id,
                qty = :qty,
                price = :price,
                modified = :modified,
                customer_id = :customer_id,
                WHERE sales_id = :sales_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':product_id' => $product_id,
                            ':qty' => $qty,
                            ':price' => $price,
                            ':modified' => time(),
                            ':customer_id' => $customer_id,
                            ':sales_id' => $sales_id);

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
        $sql = "SELECT COUNT(sales_id) AS amount_of_sales FROM tb_salestr";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_sales;
    }
    
    public function getSalesbyCategory() {
        $sql = "SELECT categories.name, COUNT(tb_salestr.product_name) AS count
                FROM `categories`
                LEFT JOIN `tb_salestr` ON tb_salestr.category = categories.id
                GROUP BY categories.id;";
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
    
    // **************************************************************************************
}