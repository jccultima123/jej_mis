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
    
    public function getAllRecords($start, $limit)
    {
        $sql = "SELECT tb_som.*,
                categories.name,
                tb_users.first_name,
                tb_users.last_name,
                tb_users.middle_name,
                tb_branch.branch_name, tb_manufacturers.manu_name, sale_status.status
                FROM `tb_som`
                LEFT JOIN categories on tb_som.category = categories.cat_id
                LEFT JOIN tb_users on tb_som.added_by = tb_users.user_id
                LEFT JOIN tb_branch on tb_som.branch = tb_branch.branch_id
                LEFT JOIN tb_manufacturers on manufacturer = tb_manufacturers.manu_id
                LEFT JOIN sale_status on status_id = sale_status.id
                ORDER BY id ASC
                LIMIT " . $start . ", " . $limit;
        $query = $this->db->prepare($sql);
        $query->execute();
        
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
    
    public function searchRecord($search) {
        if (!isset($search) OR empty($search)) {
            $_SESSION["feedback_negative"][] = FEEDBACK_ITEM_NOT_AVAILABLE;
            return false;
        } else if (preg_match("/[A-Z  | a-z]+/", $search)) {
            $sql = "SELECT tb_som.*, categories.name FROM tb_som, categories WHERE categories.name = tb_som.category AND tb_som.product_name LIKE '%" . $search . "%' OR tb_som.manufacturer LIKE '%" . $search . "%' OR categories.name LIKE '%" . $search . "%'";
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

    public function addRecord($category, $manufacturer, $product_name, $product_model, $IMEI, $user_id, $branch, $qty, $price, $status_id) {
        $sql = "INSERT INTO tb_som (category,
                manufacturer, product_name,
                product_model, IMEI, added_by,
                branch, qty, price, status_id,
                latest_timestamp)
                VALUES (:category,
                :manufacturer, :product_name,
                :product_model, :IMEI, :added_by,
                :branch, :qty, :price, :status_id,
                :latest_timestamp)";
        $query = $this->db->prepare($sql);
        $parameters = array(':category' => $category,
                            ':manufacturer' => $manufacturer,
                            ':product_name' => $product_name,
                            ':product_model' => $product_model,
                            ':IMEI' => $IMEI,
                            ':added_by' => $user_id,
                            ':branch' => $branch,
                            ':qty' => $qty,
                            ':price' => $price,
                            ':status_id' => $status_id,
                            ':latest_timestamp' => time());
        $query->execute($parameters);
        $_SESSION["feedback_positive"][] = CRUD_ADDED . Auth::detectDBEnv(Helper::debugPDO($sql, $parameters));
    }
    
    public function addRecordWithNewCustomer($category, $manufacturer, $product_name, $product_model, $IMEI, $user_id, $branch, $qty, $price, $status_id) {
        $sql = "INSERT INTO tb_som (category, manufacturer, product_name, product_model, IMEI, added_by, branch, price, status_id, latest_timestamp) VALUES (:category, :manufacturer, :product_name, :product_model, :IMEI, :added_by, :branch, :price, :status_id, :latest_timestamp)";
        $query = $this->db->prepare($sql);
        $parameters = array(':category' => $category,
                            ':manufacturer' => $manufacturer,
                            ':product_name' => $product_name,
                            ':product_model' => $product_model,
                            ':IMEI' => $IMEI,
                            ':added_by' => $user_id,
                            ':branch' => $branch,
                            ':price' => $price,
                            ':status_id' => $status_id,
                            ':latest_timestamp' => time());
        $query->execute($parameters);
        $_SESSION["feedback_positive"][] = CRUD_ADDED . Auth::detectDBEnv(Helper::debugPDO($sql, $parameters));
    }

    public function deleteRecord($id)
    {
        $sql = "DELETE FROM tb_som WHERE record_id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
        $_SESSION["feedback_positive"][] = CRUD_DELETE;
    }
    
    public function getRecord($id)
    {
        $sql = "SELECT tb_som.*,
                categories.name,
                tb_users.first_name,
                tb_users.last_name,
                tb_users.middle_name,
                tb_branch.branch_name, tb_manufacturers.manu_name, sale_status.status
                FROM `tb_som`
                LEFT JOIN categories on tb_som.category = categories.cat_id
                LEFT JOIN tb_users on tb_som.added_by = tb_users.user_id
                LEFT JOIN tb_branch on tb_som.branch = tb_branch.branch_id
                LEFT JOIN tb_manufacturers on manufacturer = tb_manufacturers.manu_id
                LEFT JOIN sale_status on status_id = sale_status.id
                WHERE record_id = :id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        $fetch = $query->fetch();
        if ($fetch) {
            return $fetch;
        } else {
            $_SESSION["feedback_negative"][] = CRUD_NOT_FOUND;
        }
    }
    
    public function updateRecord($category, $manufacturer, $product_name, $product_model, $IMEI, $user_id, $branch, $price, $status_id, $id)
    {   
        $sql = "UPDATE tb_som
                SET category = :category,
                manufacturer = :manufacturer,
                product_name = :product_name,
                product_model = :product_model,
                IMEI = :IMEI,
                added_by = :added_by,
                branch = :branch,
                price = :price,
                status_id = :status_id,
                latest_timestamp = :latest_timestamp
                WHERE record_id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':category' => $category,
                            ':manufacturer' => $manufacturer,
                            ':product_name' => $product_name,
                            ':product_model' => $product_model,
                            ':IMEI' => $IMEI,
                            ':added_by' => $user_id,
                            ':branch' => $branch,
                            ':price' => $price,
                            ':status_id' => $status_id,
                            ':latest_timestamp' => time(),
                            ':id' => $id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        if ($query->execute($parameters)) {
            $_SESSION["feedback_positive"][] = CRUD_UPDATED . Auth::detectDBEnv(Helper::debugPDO($sql, $parameters));
        } else {
            $_SESSION["feedback_negative"][] = CRUD_UNABLE_TO_EDIT . Auth::detectDBEnv(Helper::debugPDO($sql, $parameters));
        }
    }
    
    public function getRecordbyCategory() {
        $sql = "SELECT categories.name, COUNT(tb_som.product_name) AS count
                FROM `categories`
                LEFT JOIN `tb_som` ON tb_som.category = categories.cat_id
                GROUP BY categories.cat_id;";
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
    
    public function countSales()
    {
        $sql = "SELECT COUNT(sales_id) AS sales_count FROM tb_salestr";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->sales_count;
    }
    
    public function countOrders()
    {
        $sql = "SELECT COUNT(order_id) AS order_count FROM tb_orders";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->order_count;
    }
}
