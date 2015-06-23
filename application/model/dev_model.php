<?php

class DevModel
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
    
    //GET MYSQL VERSION (THE SAFEST)
    public function getMySqlVersion2()
    {
        $sql = ("SELECT VERSION()");
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->fetchColumn();
    }
    
    // *************************************************************************
    
}
