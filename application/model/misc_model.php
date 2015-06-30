<?php

class MiscModel
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
    
    public function getAllStatus()
    {
        $sql = "SELECT * FROM status";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    
    public function getAllManufacturers()
    {
        $sql = "SELECT * FROM tb_manufacturers";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    
    public function getReportTypes()
    {
        $sql = "SELECT * FROM report_type";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    
    /**
     * Returns the current state of the user's login
     * @return bool user's login status
     */
    public function isUserLoggedIn()
    {
        return Session::get('user_logged_in');
    }
    
    //CRUD for Customers
    public function addCustomer($first_name, $last_name, $middle_name, $birthday, $address, $branch) {
        $sql = "INSERT INTO tb_customers (first_name,
                last_name, middle_name,
                birthday, address, registered_branch, latest_timestamp)
                VALUES (:first_name, :last_name, :middle_name,
                :birthday, :address, :registered_branch, :latest_timestamp)";
        $query = $this->db->prepare($sql);
        $parameters = array(':first_name' => $first_name,
            ':last_name' => $last_name,
            ':middle_name' => $middle_name,
            ':birthday' => $birthday,
            ':address' => $address,
            ':registered_branch' => $branch,
            ':latest_timestamp' => time());
        $query->execute($parameters);
        $_SESSION["feedback_positive"][] = CRUD_ADDED . Auth::detectDBEnv(Helper::debugPDO($sql, $parameters));
    }

}
