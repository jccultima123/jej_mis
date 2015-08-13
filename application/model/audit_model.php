<?php

class AuditModel
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
    
    public function set_log($type, $description) {
        $sql = "INSERT INTO audit_trail (id, type, description, user, user_type, branch, ip_address, UA, date)
                VALUES (:id, :type, :description, :user, :user_type, :branch, :ip_address, :UA, :date)";
        $query = $this->db->prepare($sql);
        
        if ($_SERVER['REMOTE_ADDR'] != '::1') {
            $ip = $_SERVER['REMOTE_ADDR'];
        } else {
            $ip = 'Not Available';
        }
        
        $browser = new Browser();
        $UA = $browser->getUserAgent();
        
        $parameters = array(
            ':id' => RANDOM_NUMBER,
            ':type' => $type,
            ':description' => $description,
            ':user' => $_SESSION['user_name'],
            ':user_type' => $_SESSION['user_provider_type'],
            ':branch' => $_SESSION['branch'],
            ':ip_address' => $ip,
            ':UA' => $UA,
            ':date' => time()
        );
        $query->execute($parameters);
        try { $query->execute($parameters); } catch (PDOException $e) {
            $_SESSION["feedback_negative"][] = AT_UNABLE_TO_LOG;
        }
    }
    
    public function get_log($id) {
        $sql = "SELECT * FROM audit_trail
                WHERE id = :id
                ORDER BY date DESC";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
    }
    
    public function get_logs() {
        $sql = "SELECT * FROM audit_trail
                ORDER BY date DESC";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        $fetch = $query->fetchAll();
        if (empty($fetch)) {
            $_SESSION["feedback_negative"][] = FEEDBACK_NO_RECORDS;
            return false;
        } else {
            return $fetch;
        }
    }
}

