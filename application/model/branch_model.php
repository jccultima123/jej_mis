<?php

class BranchModel
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
    
    public function getBranches()
    {
        $sql = "SELECT * FROM tb_branch";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->fetchAll();
    }
    
    public function getBranch($id)
    {
        $sql = "SELECT * FROM tb_branch WHERE branch_id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));
        
        return $query->fetch();
    }
    
    public function countBranches()
    {
        $sql = "SELECT COUNT(*) as brcount FROM tb_branch";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->fetch()->brcount;
    }
    
    public function add($type, $branch_name, $branch_address, $branch_contact)
    {
        if (empty($_POST['type'])) {
            $_SESSION["feedback_negative"][] = "Please Select Correct Branch Type.";
            return false;
        } elseif (empty($_POST['branch_name'])) {
            $_SESSION["feedback_negative"][] = "Missing Branch Name.";
            return false;
        } elseif (empty($_POST['branch_address'])) {
            $_SESSION["feedback_negative"][] = "Address is Required.";
            return false;
        } elseif (empty($_POST['branch_contact'])) {
            $_SESSION["feedback_negative"][] = "Contact Number is needed.";
            return false;
        } elseif (
                !empty($_POST['type']) AND
                !empty($_POST['branch_name']) AND
                !empty($_POST['branch_address']) AND
                !empty($_POST['branch_contact']) AND
                !preg_match('^\(\d{3}\) \d{3}-\d{4}$', $_POST['branch_contact']) ) {
            $sql = "INSERT INTO tb_branch (type, branch_name, branch_address, branch_contact)
                    VALUES (:type, :branch_name, :branch_address, :branch_contact)";
            $query = $this->db->prepare($sql);
            $query->execute(array(
                        ':type' => $type,
                        ':branch_name' => $branch_name,
                        ':branch_address' => $branch_address,
                        ':branch_contact' => $branch_contact
                        ));
            $count =  $query->rowCount();
            if ($count != 1) {
                $_SESSION["feedback_negative"][] = "Unable to add Branch.";
                return false;
            }
            return true;
        }
    }
    
    public function update($type, $branch_name, $branch_address, $branch_contact, $branch_id)
    {
        if (empty($_POST['type'])) {
            $_SESSION["feedback_negative"][] = "Please Select Correct Branch Type.";
            return false;
        } elseif (empty($_POST['branch_name'])) {
            $_SESSION["feedback_negative"][] = "Missing Branch Name.";
            return false;
        } elseif (empty($_POST['branch_address'])) {
            $_SESSION["feedback_negative"][] = "Address is Required.";
            return false;
        } elseif (empty($_POST['branch_contact'])) {
            $_SESSION["feedback_negative"][] = "Contact Number is needed.";
            return false;
        } elseif (
                !empty($_POST['type']) AND
                !empty($_POST['branch_name']) AND
                !empty($_POST['branch_address']) AND
                !empty($_POST['branch_contact']) AND
                !preg_match('^\(\d{3}\) \d{3}-\d{4}$', $_POST['branch_contact']) ) {
            $sql = "UPDATE tb_branch SET
                    type = :type, branch_name = :branch_name, branch_address = :branch_address, branch_contact = :branch_contact
                    WHERE branch_id = :id";
            $query = $this->db->prepare($sql);
            $parameters = array(':type' => $type,
                        ':branch_name' => $branch_name,
                        ':branch_address' => $branch_address,
                        ':branch_contact' => $branch_contact,
                        ':id' => $branch_id);
            $query->execute($parameters);
            $count = $query->rowCount();
            if ($count != 1) {
                $_SESSION["feedback_negative"][] = "Unable to update. Sometimes this mostly happen when you never change any or something's wrong in the edit form.";
                return false;
            }
            return true;
        }
    }
    
    public function delete($branch_id)
    {
        $sql = "DELETE FROM tb_branch WHERE branch_id = :branch_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':branch_id' => $branch_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        try {
            if ($query->execute($parameters)) {
                $_SESSION["feedback_positive"][] = "Branch data #" . $branch_id . " was " . CRUD_DELETE . Auth::detectDBEnv(Helper::debugPDO($sql, $parameters));
                return true;
            } else {
                $_SESSION["feedback_negative"][] = CRUD_UNABLE_TO_DELETE . Auth::detectDBEnv(Helper::debugPDO($sql, $parameters));
            }
        } catch (PDOException $e) {
            $_SESSION["feedback_negative"][] = CRUD_UNABLE_TO_DELETE_CONFLICT . " Make sure you've deleted other records from branch you want to delete.";
            return false;
        }
    }
}
