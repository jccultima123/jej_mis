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
            header('Location: _fb/database.html');
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
