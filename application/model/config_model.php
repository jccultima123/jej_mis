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
    
    public function loadConfig() {
        if (!isset($_SESSION['user_id'])) {
            return false;
        }
        $sql = "SELECT * FROM config
                WHERE user = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $_SESSION['user_id']);
        $query->execute($parameters);
        $fetch = $query->fetch();
        if ($fetch) {
            return $fetch;
        } else {
            //$_SESSION["feedback_negative"][] = 'WARNING: Missing configurations detected. Please Override in user settings.';
            return false;
        }
    }
}

