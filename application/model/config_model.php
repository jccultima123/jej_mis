<?php

/*
 * ConfigModel - End-User Configurations Model
 */

class ConfigModel
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
    
    public function loadUserConfig() {
        if (!isset($_SESSION['user_id'])) {
            return false;
        } else {
            $sql = "SELECT * FROM config
                    WHERE user = :id";
            $query = $this->db->prepare($sql);
            $parameters = array(':id' => $_SESSION['user_id']);
            $query->execute($parameters);
            $fetch = $query->fetch();
            try {
                return $fetch;
            } catch (PDOException $e) {
                $_SESSION["feedback_negative"][] = 'WARNING: Missing configurations detected. Please Override in user settings.';
            }
        }
    }

    public function loadSysConfig($type) {
        switch($type) {
            case 'contacts':
                $sql = "SELECT * FROM config_sys WHERE config_name IN (:param, :param1, :param2, :param3)";
                $parameters = array(':param' => 'company_number',
                                    ':param1' => 'company_number_1',
                                    ':param2' => 'company_number_2',
                                    ':param3' => 'company_email');
                break;
            default:
                $sql = "SELECT * FROM config_sys";
                $parameters = NULL;
        }
        $query = $this->db->prepare($sql);
        $query->execute($parameters);
        $fetch = $query->fetchAll();
        try {
            return $fetch;
        } catch (PDOException $e) {
            $_SESSION["feedback_negative"][] = 'WARNING: Missing system configurations detected.';
        }
    }
}

