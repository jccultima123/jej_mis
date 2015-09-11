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
        if (isset($_SESSION['admin_logged_in'])) {
            $sql = "SELECT tb_salestr.*, tb_salestr.sales_id AS sale_id, tb_salestr.timestamp AS time, tb_salestr.branch AS sale_branch,
                    tb_users.user_name,
                    tb_branch.branch_name,
                    tb_products.*,
                    tb_product_line.*,
                    tb_customers.*
                    FROM `tb_salestr`
                    LEFT JOIN tb_products on tb_salestr.product_id = tb_products.product_id
                    LEFT JOIN tb_product_line on tb_salestr.product_id = tb_product_line.line_id
                    LEFT JOIN tb_branch on tb_salestr.branch = tb_branch.branch_id
                    LEFT JOIN tb_users on tb_salestr.added_by = tb_users.user_id
                    LEFT JOIN tb_customers on tb_salestr.customer_id = tb_customers.customer_id
                    ORDER BY time DESC";
            $query = $this->db->prepare($sql);
            $query->execute();
        } else {
            $sql = "SELECT tb_salestr.*, tb_salestr.sales_id AS sale_id, tb_salestr.timestamp AS time, tb_salestr.branch AS sale_branch,
                    tb_users.user_name,
                    tb_branch.branch_name,
                    tb_products.*,
                    tb_product_line.*,
                    tb_customers.*
                    FROM `tb_salestr`
                    LEFT JOIN tb_products on tb_salestr.product_id = tb_products.product_id
                    LEFT JOIN tb_product_line on tb_salestr.product_id = tb_product_line.line_id
                    LEFT JOIN tb_branch on tb_salestr.branch = tb_branch.branch_id
                    LEFT JOIN tb_users on tb_salestr.added_by = tb_users.user_id
                    LEFT JOIN tb_customers on tb_salestr.customer_id = tb_customers.customer_id
                    WHERE tb_salestr.branch = :branch_id
                    ORDER BY time DESC";
            $query = $this->db->prepare($sql);
            $parameters = array(':branch_id' => $_SESSION['branch_id']);
            $query->execute($parameters);
        }
        
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

    public function addSales($added_by, $branch, $product_id, $qty, $customer_id, $payment, $downpayment) {
        $sth = $this->db->prepare("SELECT tb_product_line.*, tb_products.*
                                   FROM tb_product_line
                                   LEFT JOIN `tb_products` on tb_product_line.product = tb_products.product_id
                                   WHERE product = :product AND branch = :branch");
        $sth_param = array(':product' => $product_id, ':branch' => $branch);
        $sth->execute($sth_param);
        // using PDO::FETCH_ASSOC is a better way if the row exists rather than rowCount() that counts rows
        $count = $sth->fetch(PDO::FETCH_ASSOC);
        if ($count) {
            // Re-execute again (that was lazy eh?)
            $sth->execute($sth_param);
            // then fetch from re-execution
            $result = $sth->fetch();
            //IF THE BRANCH INVENTORY IS NOT EMPTY
            if (!empty($result->inventory)) {
                //IF THE DESIRED QTY IS LESS THAN EQUAL TO THE BRANCH'S INVENTORY
                if ($qty <= $result->inventory) {
                    //SETTING UP PRICE FROM BRANCH'S INVENTORY
                    $price = $result->SRP;
                    //INSERTING RECORD
                    $sql = "INSERT INTO tb_salestr (added_by, branch, product_id, qty, price, timestamp, customer_id, payment, downpayment, remaining) VALUES (:added_by, :branch, :product_id, :qty, :price, :timestamp, :customer_id, :payment, :downpayment, :price * :qty - :downpayment)";
                    $query = $this->db->prepare($sql);
                    $time = time();
                    $parameters = array(':added_by' => $added_by,
                        ':branch' => $branch,
                        ':product_id' => $product_id,
                        ':qty' => $qty,
                        ':price' => $price,
                        ':timestamp' => $time,
                        ':customer_id' => $customer_id,
                        ':payment' => $payment,
                        ':downpayment' => $downpayment
                        );
                    if ($query->execute($parameters)) {
                        //UPDATING ENTRY INTO BRANCH'S INVENTORY
                        $sql_a = "UPDATE tb_product_line
                                SET inventory = inventory - :stocks
                                WHERE product = :product_id AND branch = :branch";
                        $q_a = $this->db->prepare($sql_a);
                        $q_a->execute(
                            array(
                            ':product_id' => $product_id,
                            ':stocks' => $qty,
                            ':branch' => $branch)
                            );
                        //UPDATING SELLOUT
                        $sql_b = "UPDATE tb_product_line
                                SET sellout = sellout + :stocks
                                WHERE product = :product_id AND branch = :branch";
                        $q_b = $this->db->prepare($sql_b);
                        $q_b->execute(
                            array(
                            ':product_id' => $product_id,
                            ':stocks' => $qty,
                            ':branch' => $branch)
                            );

                        //$this->addInstallment($time, $downpayment, $remaining);

                        $_SESSION["feedback_positive"][] = CRUD_ADDED . '&nbsp;&nbsp;<a class="btn btn-primary" target="_blank" href=' . URL . 'SOM/receipt/' . $product_id . '/' . $time . '>Generate Sales Invoice</a>';
                        return true;
                    } else {
                        $_SESSION["feedback_negative"][] = CRUD_UNABLE_TO_ADD;
                        header('location: ' . PREVIOUS_PAGE);
                        return false;
                    }
                } else {
                    $_SESSION["feedback_negative"][] = OUT_OF_STOCKS;
                    return false;
                }
            } else {
                $_SESSION["feedback_negative"][] = "<strong>WARNING:</strong> There's something's wrong with your inventory. Therefore, it was not recorded. The Result was: " . Auth::exists($result->inventory);
                return false;
            }
        } else {
            $_SESSION["feedback_negative"][] = CRUD_UNABLE_TO_ADD . " It may be your product in inventory does not exist or in a serious error.";
            return false;
        }
    }
        //sub-functions for add sales

        /* DISABLED FOR NOW
        function addInstallment($timestamp, $downpayment, $remaining)
        {
            $sql = "SELECT * FROM tb_salestr WHERE timestamp = :timestamp";
            $query = $this->db->prepare($sql);
            $parameters = array(':timestamp' => $timestamp);
            $query->execute($parameters);
            $fetch = $query->fetch();

            if ($fetch) {
                //obtaining data
                $sales_id = $fetch->sales_id;
                $customer = $fetch->customer_name;
                $time = $fetch->timestamp;

                $sql_2 = "INSERT INTO tb_installments
                          (sales_id, customer, downpayment, remaining, timestamp)
                          VALUES (:sales_id, :customer, :downpayment, :remaining, :timestamp)";
                $query_2 = $this->db->prepare($sql_2);
                $query->execute(array(
                    ':sales_id' => $sales_id,
                    ':customer' => $customer,
                    ':downpayment' => $downpayment,
                    ':remaining' => $remaining,
                    ':timestamp' => $time
                ));

                $fetch_2 = $query_2->fetch();
                try {
                    $fetch_2;
                } catch (PDOException $e) {
                    $_SESSION["feedback_negative"][] = "Unable to add installment basis.";
                    return false;
                }
                return true;
            } else {
                $_SESSION["feedback_negative"][] = "Unable to add installment basis.";
                return false;
            }
        }
        */

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
            $sql = "SELECT tb_salestr.*, tb_salestr.sales_id AS sale_id, tb_salestr.timestamp AS time, tb_salestr.branch AS sale_branch,
                    tb_users.user_name,
                    tb_branch.branch_name,
                    tb_products.*,
                    tb_product_line.*,
                    tb_customers.*
                    FROM `tb_salestr`
                    LEFT JOIN tb_products on tb_salestr.product_id = tb_products.product_id
                    LEFT JOIN tb_product_line on tb_salestr.product_id = tb_product_line.line_id
                    LEFT JOIN tb_branch on tb_salestr.branch = tb_branch.branch_id
                    LEFT JOIN tb_users on tb_salestr.added_by = tb_users.user_id
                    LEFT JOIN tb_customers on tb_salestr.customer_id = tb_customers.customer_id
                    WHERE tb_salestr.sales_id = :sales_id";
            $query = $this->db->prepare($sql);
            $parameters = array(':sales_id' => $sales_id);
            $query->execute($parameters);
        } else {
            $sql = "SELECT tb_salestr.*, tb_salestr.sales_id AS sale_id, tb_salestr.timestamp AS time, tb_salestr.branch AS sale_branch,
                    tb_users.user_name,
                    tb_branch.branch_name,
                    tb_products.*,
                    tb_product_line.*,
                    tb_customers.*
                    FROM `tb_salestr`
                    LEFT JOIN tb_products on tb_salestr.product_id = tb_products.product_id
                    LEFT JOIN tb_product_line on tb_salestr.product_id = tb_product_line.line_id
                    LEFT JOIN tb_branch on tb_salestr.branch = tb_branch.branch_id
                    LEFT JOIN tb_users on tb_salestr.added_by = tb_users.user_id
                    LEFT JOIN tb_customers on tb_salestr.customer_id = tb_customers.customer_id
                    WHERE tb_salestr.sales_id = :sales_id AND tb_salestr.branch = :branch_id";
            $query = $this->db->prepare($sql);
            $parameters = array(':sales_id' => $sales_id, ':branch_id' => $_SESSION['branch_id']);
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
    
    public function updateSales($product_id, $qty, $customer_id, $downpayment, $sales_id)
    {   
        $sql = "UPDATE tb_salestr
                SET product_id = :product_id,
                qty = :qty,
                timestamp = :timestamp,
                downpayment = :downpayment,
                remaining = remaining - :downpayment,
                customer_id = :customer_id
                WHERE sales_id = :sales_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':product_id' => $product_id,
                            ':qty' => $qty,
                            ':timestamp' => time(),
                            ':downpayment' => $downpayment,
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
    
    public function countTransactions()
    {
        $sql = "SELECT COUNT(sales_id) AS transaction_count FROM tb_salestr";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->transaction_count;
    }
    
    public function countTransactionsByBranch($branch_id)
    {
        $sql = "SELECT COUNT(sales_id) AS transaction_count_by_branch FROM tb_salestr WHERE branch = :branch_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':branch_id' => $branch_id);
        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->transaction_count_by_branch;
    }
    
    public function getStatus()
    {
        $sql = "SELECT * FROM sale_status";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    
    // **************************************************************************************
    // REPORTS
    
    public function totalSales()
    {
        $sql = "SELECT SUM(tb_salestr.price) AS total_sales FROM tb_salestr";
        $query = $this->db->prepare($sql);
        //$parameters = array(':branch_id' => $_SESSION['branch_id']);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        $r = $query->fetch()->total_sales;
        if ($r) {
            return $r;
        } else {
            return false;
        }
    }
    
    public function largestDailySalesDate()
    {
        $sql = "SELECT timestamp AS date, SUM(price) AS price,
                tb_branch.*
                FROM tb_salestr
                LEFT JOIN tb_branch on tb_salestr.branch = tb_branch.branch_id
                WHERE price = (SELECT MAX(price) FROM tb_salestr)
                ORDER BY price DESC";
        $query = $this->db->prepare($sql);
        //$parameters = array(':branch_id' => $_SESSION['branch_id']);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        $r = $query->fetch();
        if ($r) {
            return $r;
        } else {
            return false;
        }
    }
    
    public function topSalesSold()
    {
        $sql = "SELECT tb_salestr.*,
                tb_users.*,
                tb_products.*
                FROM `tb_salestr`
                LEFT JOIN tb_products on tb_salestr.product_id = tb_products.product_id
                LEFT JOIN tb_users on tb_salestr.added_by = tb_users.user_id
                ORDER BY tb_salestr.qty DESC";
        $query = $this->db->prepare($sql);
        //$parameters = array(':branch_id' => $_SESSION['branch_id']);
        $query->execute();

        $r = $query->fetch();
        if ($r) {
            return $r;
        } else {
            return false;
        }
    }

    public function salesInvoice($product_id, $timestamp)
    {
        $sql = "SELECT tb_salestr.*,
                tb_salestr.timestamp AS time,
                tb_products.*
                FROM tb_salestr
                LEFT JOIN tb_products on tb_salestr.product_id = tb_products.product_id
                WHERE tb_salestr.product_id = :product_id AND tb_salestr.timestamp = :timestamp";
        $query = $this->db->prepare($sql);
        $parameters = array(':product_id' => $product_id, ':timestamp' => $timestamp);
        $query->execute($parameters);

        $r = $query->fetch();
        if ($r) {
            return $r;
        } else {
            $_SESSION["feedback_negative"][] = CRUD_NOT_FOUND;
            return false;
        }
    }
}