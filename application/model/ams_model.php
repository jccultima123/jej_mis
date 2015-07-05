<?php

class AmsModel
{

    public function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            $ERROR = "The database was either unable to connect or doesn't exists.<hr /><b>DEBUG:</b> " . $e . "<hr />";
            require_once '_fb/error.html';
            exit;
        }
    }
    
    public function getAllAssets($start, $limit)
    {
        if (isset($_SESSION['admin_logged_in'])) {
            $sql = "SELECT * FROM tb_assets
                    ORDER BY timestamp DESC
                    LIMIT " . $start . ", " . $limit;
            $query = $this->db->prepare($sql);
            $query->execute();
        } else {
            $branch_id = $_SESSION['branch_id'];
            $sql = "SELECT * FROM tb_assets
                    WHERE tb_assets.branch = :branch_id
                    ORDER BY timestamp DESC
                    LIMIT " . $start . ", " . $limit;
            $query = $this->db->prepare($sql);
            $parameters = array(':branch_id' => $branch_id);
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
    
    public function getAssetTypes()
    {
        $sql = "SELECT * FROM asset_type";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->fetchAll();
    }
    
    public function addTransaction($user, $branch, $type, $name, $description, $qty, $price)
    {
        $sql = "INSERT INTO tb_assets (user, branch, type, name, description, qty, price, as_status, accumulated, timestamp)
                VALUES (:user, :branch, :type, :name, :description, :qty, :price, :as_status, :accumulated, :timestamp)";
        $query = $this->db->prepare($sql);
        $parameters = array(':user' => $user,
            ':branch' => $branch,
            ':type' => $type,
            ':name' => $name,
            ':description' => $description,
            ':qty' => $qty,
            ':price' => $price,
            ':as_status' => 1,
            ':accumulated' => time(),
            ':timestamp' => time());
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
        $sql = "SELECT COUNT(asset_id) AS transaction_count FROM tb_assets";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->transaction_count;
    }
    
    public function countTransactionsByBranch($branch_id)
    {
        $sql = "SELECT COUNT(asset_id) AS transaction_count_by_branch FROM tb_assets WHERE branch = :branch_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':branch_id' => $branch_id);
        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->transaction_count_by_branch;
    }

    /**
     * Log out process, deletes cookie, deletes session
     */
    public function logout()
    {
        if (!isset($_SESSION['AMS_user_logged_in'])) {
            $_SESSION["feedback_positive"][] = FEEDBACK_INVALID_LOGOUT;
        } else {
            // delete the session
            Session::destroy();
            // init again for message
            Session::init();
            $_SESSION["feedback_positive"][] = FEEDBACK_LOGGED_OUT;
        }
    }

}
