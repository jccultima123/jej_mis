<?php

class CrmModel
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

    /**
     * Log out process, deletes cookie, deletes session
     */
    public function logout()
    {
        if (!isset($_SESSION['CRM_user_logged_in'])) {
            $_SESSION["feedback_positive"][] = FEEDBACK_INVALID_LOGOUT;
        } else {
            // delete the session
            Session::destroy();
            // init again for message
            Session::init();
            $_SESSION["feedback_positive"][] = FEEDBACK_LOGGED_OUT;
        }
    }
    
    /**
     * Checks if the entered captcha is the same like the one from the rendered image which has been saved in session
     * @return bool success of captcha check
     */
    private function checkCaptcha()
    {
        if (isset($_POST["captcha"]) AND ($_POST["captcha"] == $_SESSION['captcha'])) {
            return true;
        }
        // default return
        return false;
    }
    
    public function getAllCustomers()
    {
        if (!isset($_SESSION['admin_logged_in'])) {
            $branch_id = $_SESSION['branch_id'];
            $sql = "SELECT * FROM tb_customers WHERE registered_branch = :branch_id ORDER BY registered_date DESC";
            $query = $this->db->prepare($sql);
            $query->execute(array(':branch_id' => $branch_id));
        } else {
            $sql = "SELECT * FROM tb_customers ORDER BY registered_date DESC";
            $query = $this->db->prepare($sql);
            $query->execute();
        }
        $fetch = $query->fetchAll();
        if (empty($fetch)) {
            $_SESSION["feedback_negative"][] = FEEDBACK_NO_RECORDS;
            return false;
        } else {
            return $fetch;
        }
    }
    
    public function getAmountOfCustomers()
    {
        $sql = "SELECT COUNT(customer_id) AS amount_of_customers FROM tb_customers";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_customers;
    }
    
    public function countCustomers()
    {
        $sql = "SELECT COUNT(customer_id) AS customer_count FROM tb_customers";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->customers_count;
    }
    
    public function getAllFeedbacks()
    {
        $branch_id = $_SESSION['branch_id'];
        $sql = "SELECT * FROM tb_feedbacks ORDER BY created OR modified DESC";
        $query = $this->db->prepare($sql);
        $query->execute(array(':branch_id' => $branch_id));
        
        $fetch = $query->fetchAll();
        if (empty($fetch)) {
            $_SESSION["feedback_negative"][] = FEEDBACK_NO_RECORDS;
            return false;
        } else {
            return $fetch;
        }
    }
    
    public function countFeedbacks()
    {
        $sql = "SELECT COUNT(feedback_id) AS feedback_count FROM tb_feedbacks";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->feedback_count;
    }
    
    public function countUnreadFeedbacks()
    {
        $sql = "SELECT COUNT(feedback_id) AS unread_feedback_count FROM tb_feedbacks WHERE unread = 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->unread_feedback_count;
    }
    
    //CRUD for Customers
    public function addCustomer($customer_id, $first_name, $last_name, $middle_name, $birthday, $address, $branch) {
        $sql = "INSERT INTO tb_customers (customer_id, first_name,
                last_name, middle_name, birthday, address, registered_branch, registered_date)
                VALUES (:customer_id, :first_name, :last_name, :middle_name,
                :birthday, :address, :registered_branch, :registered_date)";
        $query = $this->db->prepare($sql);
        $parameters = array(':customer_id' => $customer_id,
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':middle_name' => $middle_name,
            ':birthday' => $birthday,
            ':address' => $address,
            ':registered_branch' => $branch,
            ':registered_date' => time());
        if ($query->execute($parameters)) {
            $_SESSION["feedback_positive"][] = CRUD_ADDED . Auth::detectDBEnv(Helper::debugPDO($sql, $parameters));
        } else {
            $_SESSION["feedback_negative"][] = CRUD_UNABLE_TO_ADD . Auth::detectDBEnv(Helper::debugPDO($sql, $parameters));
        }
    }
    
}
