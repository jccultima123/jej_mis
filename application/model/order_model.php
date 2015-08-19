<?php

/** FOR ORDERS **/
class OrderModel
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
    
    public function getAllOrders()
    {
        if (isset($_SESSION['admin_logged_in'])) {
            $sql = "SELECT tb_orders.*, tb_orders.stocks AS order_stocks,
                    tb_suppliers.supplier_name,
                    tb_products.*,
                    tb_users.user_name,
                    tb_branch.branch_name,
                    order_status.status
                    FROM tb_orders
                    LEFT JOIN tb_suppliers on tb_orders.supplier = tb_suppliers.supplier_id
                    LEFT JOIN tb_products on tb_orders.product_id = tb_products.product_id
                    LEFT JOIN tb_users on tb_orders.added_by = tb_users.user_id
                    LEFT JOIN tb_branch on tb_orders.order_branch = tb_branch.branch_id
                    LEFT JOIN order_status on tb_orders.order_stats = order_status.os_id
                    ORDER BY order_date DESC";
            $query = $this->db->prepare($sql);
            $query->execute();
        } else {
            $branch_id = $_SESSION['branch_id'];
            $sql = "SELECT tb_orders.*, tb_orders.stocks AS order_stocks,
                    tb_suppliers.supplier_name,
                    tb_products.*,
                    tb_users.user_name,
                    tb_branch.branch_name,
                    order_status.status
                    FROM tb_orders
                    LEFT JOIN tb_suppliers on tb_orders.supplier = tb_suppliers.supplier_id
                    LEFT JOIN tb_products on tb_orders.product_id = tb_products.product_id
                    LEFT JOIN tb_users on tb_orders.added_by = tb_users.user_id
                    LEFT JOIN tb_branch on tb_orders.order_branch = tb_branch.branch_id
                    LEFT JOIN order_status on tb_orders.order_stats = order_status.os_id
                    WHERE order_branch = :branch_id
                    ORDER BY order_date DESC";
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
    
    public function getLatestOrder()
    {
        $sql = "SELECT tb_orders.*,
                tb_suppliers.supplier_name,
                tb_products.*,
                tb_users.user_name,
                tb_branch.branch_name,
                order_status.status
                FROM tb_orders
                LEFT JOIN tb_suppliers on tb_orders.supplier = tb_suppliers.supplier_id
                LEFT JOIN tb_products on tb_orders.product_id = tb_products.product_id
                LEFT JOIN tb_users on tb_orders.added_by = tb_users.user_id
                LEFT JOIN tb_branch on tb_orders.order_branch = tb_branch.branch_id
                LEFT JOIN order_status on tb_orders.order_stats = order_status.os_id " .
                // WHERE order_branch = :branch_id
                "ORDER BY order_date DESC";
        $query = $this->db->prepare($sql);
        //$parameters = array(':branch_id' => $_SESSION['branch_id']);
        $query->execute();
        
        $fetch = $query->fetch();
        if (empty($fetch)) {
            $_SESSION["feedback_negative"][] = FEEDBACK_NO_ITEMS;
            return false;
        } else {
            return $fetch;
        }
    }
    
    public function getOrderTimestamp()
    {
        $sql = "SELECT MIN(order_date) AS min_date, MAX(order_date) AS max_date
                FROM tb_orders
                ORDER BY order_date DESC";
        $query = $this->db->prepare($sql);
        $parameters = array(':branch_id' => $_SESSION['branch_id']);
        $query->execute($parameters);
        
        $fetch = $query->fetch();
        if (empty($fetch)) {
            $_SESSION["feedback_negative"][] = FEEDBACK_NO_ITEMS;
            return false;
        } else {
            return $fetch;
        }
    }
    
    public function getOrder($order_id)
    {
        if (isset($_SESSION['admin_logged_in'])) {
            $sql = "SELECT tb_orders.*,
                    tb_suppliers.supplier_name,
                    tb_products.*,
                    tb_users.user_name,
                    tb_branch.branch_name,
                    order_status.status
                    FROM tb_orders
                    LEFT JOIN tb_suppliers on tb_orders.supplier = tb_suppliers.supplier_id
                    LEFT JOIN tb_products on tb_orders.product_id = tb_products.product_id
                    LEFT JOIN tb_users on tb_orders.added_by = tb_users.user_id
                    LEFT JOIN tb_branch on tb_orders.order_branch = tb_branch.branch_id
                    LEFT JOIN order_status on tb_orders.order_stats = order_status.os_id
                    WHERE order_id = :order_id";
            $query = $this->db->prepare($sql);
            $parameters = array(':order_id' => $order_id);
            $query->execute($parameters);
        } else {
            $branch_id = $_SESSION['branch_id'];
            $sql = "SELECT tb_orders.*,
                    tb_suppliers.supplier_name,
                    tb_products.*,
                    tb_users.user_name,
                    tb_branch.branch_name,
                    order_status.status
                    FROM tb_orders
                    LEFT JOIN tb_suppliers on tb_orders.supplier = tb_suppliers.supplier_id
                    LEFT JOIN tb_products on tb_orders.product_id = tb_products.product_id
                    LEFT JOIN tb_users on tb_orders.added_by = tb_users.user_id
                    LEFT JOIN tb_branch on tb_orders.order_branch = tb_branch.branch_id
                    LEFT JOIN order_status on tb_orders.order_stats = order_status.os_id
                    WHERE order_id = :order_id AND order_branch = :branch_id";
            $query = $this->db->prepare($sql);
            $parameters = array(':order_id' => $order_id, ':branch_id' => $branch_id);
            $query->execute($parameters);
        }
        
        $fetch = $query->fetch();
        if ($fetch) {
            return $fetch;
        } else {
            $_SESSION["feedback_negative"][] = CRUD_NOT_FOUND;
        }
    }
    
    public function addOrder($added_by, $order_branch, $product_id, $srp, $stocks, $comments) {
        $sql = "INSERT INTO tb_orders
                (added_by, order_branch, product_id, SRP, stocks, comments, order_date)
                VALUES
                (:added_by, :order_branch, :product_id, :SRP, :stocks, :comments, :order_date)";
        $query = $this->db->prepare($sql);
        $parameters = array(':added_by' => $added_by,
            ':order_branch' => $order_branch,
            ':product_id' => $product_id,
            ':SRP' => $srp,
            ':stocks' => $stocks,
            ':comments' => $comments,
            ':order_date' => time());
        if ($query->execute($parameters)) {
            $_SESSION["feedback_positive"][] = CRUD_ADDED . Auth::detectDBEnv(Helper::debugPDO($sql, $parameters));
            return true;
        } else {
            $_SESSION["feedback_negative"][] = CRUD_UNABLE_TO_ADD . Auth::detectDBEnv(Helper::debugPDO($sql, $parameters));
            header('location: ' . PREVIOUS_PAGE);
        }
    }
    
    public function deleteOrder($order_id)
    {
        $sql = "DELETE FROM tb_orders WHERE order_id = :order_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':order_id' => $order_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
        $_SESSION["feedback_positive"][] = CRUD_DELETE;
    }
    
    public function countTransactions()
    {
        $sql = "SELECT COUNT(order_id) AS transaction_count FROM tb_orders";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->transaction_count;
    }
    
    public function countTransactionsByBranch($branch_id)
    {
        $sql = "SELECT COUNT(order_id) AS transaction_count_by_branch FROM tb_orders WHERE order_branch = :branch_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':branch_id' => $branch_id);
        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->transaction_count_by_branch;
    }
    
    public function acceptOrder($order_id, $category, $product_id, $srp, $stocks, $branch)
    {               
        $sth = $this->db->prepare("UPDATE tb_orders
                                   SET accepted = 1, order_stats = 1
                                   WHERE order_id = :order_id");
        $sth->execute(array(':order_id' => $order_id));
        $count = $sth->rowCount();
        if ($count) {
            
            //CHECKING IF PRODUCT WAS EXISTED
            $sql1 = "SELECT * FROM tb_product_line
                    WHERE branch = :branch_id";
            $q1 = $this->db->prepare($sql1);
            $q1->execute(array(':branch_id' => $branch));
            
            $row = $q1->fetch();
                
                if ($row->product == $product_id AND $row->branch = $branch) {
                    $stock_count = $this->checkStocks($product_id);
                    if ($stocks > $stock_count->inventory_count) {
                        $this->cancelOrder($order_id);
                        $_SESSION["feedback_negative"][] = OUT_OF_STOCKS . ' Current Stock Count' . $stock_count->inventory_count;
                        return false;
                    }
                    //UPDATING ENTRY INTO BRANCH'S INVENTORY
                    $sql1_a = "UPDATE tb_product_line
                            SET inventory = inventory + :stocks,
                            timestamp = :timestamp
                            WHERE product = :product_id AND branch = :branch";
                    // prepare $sql1_a
                    $q_a = $this->db->prepare($sql1_a);
                    $q_a->execute(
                        array(
                        ':product_id' => $product_id,
                        ':stocks' => $stocks,
                        ':timestamp' => time(),
                        ':branch' => $branch)
                        );
                    $q_a_count = $q_a->rowCount();
                    if ($q_a_count != 1) {
                        $this->cancelOrder($order_id);
                        $_SESSION["feedback_negative"][] = FEEDBACK_ORDER_FAILED;
                        return false;
                    }
                } else {
                    //CREATING
                    $sql1_b = "INSERT INTO tb_product_line (branch, category, product, SRP, inventory, created)
                        VALUES (:branch, :category, :product, :SRP, :stocks, :created)";
                    // prepare $sql1_b
                    $q_b = $this->db->prepare($sql1_b);
                    $q_b_param = array(
                        ':branch' => $branch,
                        ':category' => $category,
                        ':product' => $product_id,
                        ':SRP' => $srp,
                        ':stocks' => $stocks,
                        ':created' => time());
                    $q_b_action = $q_b->execute($q_b_param);
                    if (!$q_b_action) {
                        $this->cancelOrder($order_id);
                        $_SESSION["feedback_negative"][] = FEEDBACK_ORDER_FAILED . "Cause: Inventory";
                        return false;
                    }
                }
                
                //UPDATING STOCKS IN MAIN INVENTORY
                $update = $this->updateStocks('update', $stocks, $product_id);
                if (!$update) {
                    $this->updateStocks('cancel', $stocks, $product_id);
                    $this->cancelOrder($order_id);
                    $_SESSION["feedback_negative"][] = FEEDBACK_ORDER_FAILED . ' Therefore, updating order was cancelled.';
                    return false;
                }
                
            $_SESSION["feedback_positive"][] = FEEDBACK_ORDER_ACCEPTED;
            return true;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_ORDER_FAILED;
            return false;
        }
    }
    
        /** SUB-FUNCTIONS FOR ACCEPTING/CANCEL ORDER **/
        public function checkStocks($product) {
            if (isset($product)) {
                $sql = "SELECT * FROM tb_products
                        WHERE product_id = :product_id";
                $query = $this->db->prepare($sql);
                $parameters = array(':product_id' => $product);
                $query->execute($parameters);
                return $query->fetch();
            } else {
                return false;
            }
        }
        public function updateStocks($action, $stocks, $product) {
            if (isset($action)) {
                $sql = "UPDATE tb_products SET
                                inventory_count = inventory_count - :inventory_count,
                                timestamp = :timestamp
                                WHERE product_id = :product_id";
                        $query = $this->db->prepare($sql);
                        $parameters = array(':inventory_count' => $stocks,
                                            ':timestamp' => time(),
                                            ':product_id' => $product);
                        $query->execute($parameters);                        
                        $_SESSION["feedback_positive"][] = '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);
                        return true;
            } else {
                $_SESSION["feedback_negative"][] = 'WARNING! Unspecified function call in inventory. Manual operation might require to manage stocks.';
                return false;
            }
        }
    
        public function cancelOrder($order_id)
        {
            $sql = "UPDATE tb_orders
                    SET accepted = 0, order_stats = 0
                    WHERE order_id = :order_id";
            $query = $this->db->prepare($sql);
            $parameters = array(':order_id' => $order_id);
            $query->execute($parameters);
        }
        
    public function rejectOrder($order_id)
    {   
        $sth = $this->db->prepare("UPDATE tb_orders
                                   SET accepted = 0, order_stats = 2
                                   WHERE order_id = :order_id");
        $sth->execute(array(':order_id' => $order_id));
        $count = $sth->rowCount();
        if ($count == 1) {
            $_SESSION["feedback_positive"][] = FEEDBACK_ORDER_REJECTED;
            return true;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_ORDER_FAILED;
            return false;
        }
    }
}