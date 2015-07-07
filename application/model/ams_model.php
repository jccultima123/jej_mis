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
            $sql = "SELECT tb_assets.*,
                    tb_branch.branch_name,
                    tb_departments.department_name,
                    asset_type.type AS atype,
                    asset_status.status
                    FROM tb_assets
                    LEFT JOIN tb_branch on tb_assets.branch = tb_branch.branch_id
                    LEFT JOIN tb_departments on tb_assets.department = tb_departments.department_id
                    LEFT JOIN asset_type on tb_assets.type = asset_type.id
                    LEFT JOIN asset_status on tb_assets.as_status = asset_status.as_id
                    ORDER BY timestamp DESC
                    LIMIT " . $start . ", " . $limit;
            $query = $this->db->prepare($sql);
            $query->execute();
        } else {
            $branch_id = $_SESSION['branch_id'];
            $sql = "SELECT tb_assets.*,
                    tb_branch.branch_name,
                    tb_departments.department_name,
                    asset_type.type AS atype,
                    asset_status.status
                    FROM tb_assets
                    LEFT JOIN tb_branch on tb_assets.branch = tb_branch.branch_id
                    LEFT JOIN tb_departments on tb_assets.department = tb_departments.department_id
                    LEFT JOIN asset_type on tb_assets.type = asset_type.id
                    LEFT JOIN asset_status on tb_assets.as_status = asset_status.as_id
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
    
    public function asset($asset_id)
    {
        if (isset($_SESSION['admin_logged_in'])) {
            $sql = "SELECT tb_assets.*,
                    tb_users.*,
                    tb_branch.branch_name,
                    tb_departments.department_name,
                    asset_type.type AS atype,
                    asset_status.status
                    FROM tb_assets
                    LEFT JOIN tb_users on tb_assets.user = tb_users.user_id
                    LEFT JOIN tb_branch on tb_assets.branch = tb_branch.branch_id
                    LEFT JOIN tb_departments on tb_assets.department = tb_departments.department_id
                    LEFT JOIN asset_type on tb_assets.type = asset_type.id
                    LEFT JOIN asset_status on tb_assets.as_status = asset_status.as_id
                    WHERE tb_assets.asset_id = :asset_id
                    ORDER BY timestamp DESC";
            $query = $this->db->prepare($sql);
            $parameters = array(':asset_id' => $asset_id);
            $query->execute($parameters);
        } else {
            $branch_id = $_SESSION['branch_id'];
            $sql = "SELECT tb_assets.*,
                    tb_users.*,
                    tb_branch.branch_name,
                    tb_departments.department_name,
                    asset_type.type AS atype,
                    asset_status.status
                    FROM tb_assets
                    LEFT JOIN tb_users on tb_assets.user = tb_users.user_id
                    LEFT JOIN tb_branch on tb_assets.branch = tb_branch.branch_id
                    LEFT JOIN tb_departments on tb_assets.department = tb_departments.department_id
                    LEFT JOIN asset_type on tb_assets.type = asset_type.id
                    LEFT JOIN asset_status on tb_assets.as_status = asset_status.as_id
                    WHERE tb_assets.asset_id = :asset_id AND tb_assets.branch = :branch_id
                    ORDER BY timestamp DESC";
            $query = $this->db->prepare($sql);
            $parameters = array(':asset_id' => $asset_id, ':branch_id' => $branch_id);
            $query->execute($parameters);
        }
        
        $fetch = $query->fetch();
        if (empty($fetch)) {
            $_SESSION["feedback_negative"][] = CRUD_NOT_FOUND;
            return false;
        } else {
            return $fetch;
        }
    }
    
    public function countAssets()
    {
        $sql = "SELECT COUNT(asset_id) AS asset_count FROM tb_assets";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->asset_count;
    }
    
    public function departments()
    {
        $sql = "SELECT * FROM tb_departments";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    
    public function getStatus()
    {
        $sql = "SELECT * FROM asset_status";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    
    public function getAssetTypes()
    {
        $sql = "SELECT * FROM asset_type";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->fetchAll();
    }
    
    public function addTransaction($user, $branch, $type, $name, $description, $qty, $price, $department)
    {
        $sql = "INSERT INTO tb_assets (user, branch, type, name, description, qty, price, department, created, timestamp)
                VALUES (:user, :branch, :type, :name, :description, :qty, :price, :department, :created, :timestamp)";
        $query = $this->db->prepare($sql);
        $parameters = array(':user' => $user,
            ':branch' => $branch,
            ':type' => $type,
            ':name' => $name,
            ':description' => $description,
            ':qty' => $qty,
            ':price' => $price,
            ':department' => $department,
            ':created' => time(),
            ':timestamp' => time());
        if ($query->execute($parameters)) {
            $_SESSION["feedback_positive"][] = CRUD_ADDED . Auth::detectDBEnv(Helper::debugPDO($sql, $parameters));
            return true;
        } else {
            $_SESSION["feedback_negative"][] = CRUD_UNABLE_TO_ADD . Auth::detectDBEnv(Helper::debugPDO($sql, $parameters));
            header('location: ' . PREVIOUS_PAGE);
        }
    }
    
    public function updateTransaction($type, $name, $description, $qty, $price, $department, $as_status, $asset_id)
    {
        $sql = "UPDATE tb_assets SET
                type = :type,
                name = :name,
                description = :description,
                qty = :qty,
                price = :price,
                department = :department,
                as_status = :as_status,
                timestamp = :timestamp
                WHERE asset_id = :asset_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':type' => $type,
                            ':name' => $name,
                            ':description' => $description,
                            ':qty' => $qty,
                            ':price' => $price,
                            ':department' => $department,
                            ':as_status' => $as_status,
                            ':timestamp' => time(),
                            ':asset_id' => $asset_id);
        if ($query->execute($parameters)) {
            $_SESSION["feedback_positive"][] = CRUD_UPDATED . Auth::detectDBEnv(Helper::debugPDO($sql, $parameters));
            return true;
        } else {
            $_SESSION["feedback_negative"][] = CRUD_UNABLE_TO_EDIT . Auth::detectDBEnv(Helper::debugPDO($sql, $parameters));
            header('location: ' . PREVIOUS_PAGE);
        }
    }
    
    public function delete($asset_id)
    {
        $sql = "DELETE FROM tb_assets WHERE asset_id = :asset_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':asset_id' => $asset_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
        $_SESSION["feedback_positive"][] = CRUD_DELETE;
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
