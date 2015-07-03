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
    
    public function getAllOrders($start, $limit)
    {
        if (isset($_SESSION['admin_logged_in'])) {
            $sql = "SELECT tb_orders.*,
                    tb_products.*,
                    tb_branch.branch_name,
                    order_status.status
                    FROM tb_orders
                    LEFT JOIN tb_products on tb_orders.product_id = tb_products.product_id
                    LEFT JOIN tb_branch on tb_orders.order_branch = tb_branch.branch_id
                    LEFT JOIN order_status on tb_orders.order_stats = order_status.os_id
                    LIMIT " . $start . ", " . $limit;
            $query = $this->db->prepare($sql);
            $query->execute();
        } else {
            $branch_id = $_SESSION['branch_id'];
            $sql = "SELECT tb_orders.*,
                    tb_products.*,
                    tb_branch.branch_name
                    FROM tb_orders
                    LEFT JOIN tb_products on tb_orders.product_id = tb_products.product_id
                    LEFT JOIN tb_branch on tb_orders.order_branch = tb_branch.branch_id
                    LEFT JOIN order_status on tb_orders.order_stats = order_status.os_id
                    WHERE order_branch = :branch_id
                    ORDER BY order_date DESC
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
    
    public function getOrder($order_id)
    {
        if (isset($_SESSION['admin_logged_in'])) {
            $sql = "SELECT tb_orders.*,
                    tb_products.*,
                    tb_branch.branch_name
                    FROM tb_orders
                    LEFT JOIN tb_products on tb_orders.product_id = tb_products.product_id
                    LEFT JOIN tb_branch on tb_orders.order_branch = tb_branch.branch_id
                    WHERE order_id = order_id";
            $query = $this->db->prepare($sql);
            $parameters = array(':order_id' => $order_id);
            $query->execute($parameters);
        } else {
            $branch_id = $_SESSION['branch_id'];
            $sql = "SELECT tb_orders.*,
                    tb_products.*,
                    tb_branch.branch_name
                    FROM tb_orders
                    LEFT JOIN tb_products on tb_orders.product_id = tb_products.product_id
                    LEFT JOIN tb_branch on tb_orders.order_branch = tb_branch.branch_id
                    WHERE accepted != 0 AND order_id = :order_id AND order_branch = :branch_id";
            $query = $this->db->prepare($sql);
            $parameters = array(':order_id' => $order_id, ':branch_id' => $branch_id);
            $query->execute($parameters);
        }
        $query = $this->db->prepare($sql);
        $query->execute();
        
        $fetch = $query->fetch();
        if ($fetch) {
            return $fetch;
        } else {
            $_SESSION["feedback_negative"][] = CRUD_NOT_FOUND;
        }
    }
    
    public function addOrder($supplier, $added_by, $order_branch, $product_id, $srp, $stocks, $comments) {
        $sql = "INSERT INTO tb_orders
                (supplier, added_by, order_branch, product_id, srp, stocks, comments, order_date)
                VALUES
                (:supplier, :added_by, :order_branch, :product_id, :srp, :stocks, :comments, :order_date)";
        $query = $this->db->prepare($sql);
        $parameters = array(':supplier' => $supplier,
            ':added_by' => $added_by,
            ':order_branch' => $order_branch,
            ':product_id' => $product_id,
            ':srp' => $srp,
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
}