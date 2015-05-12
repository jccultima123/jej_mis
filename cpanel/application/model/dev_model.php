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
            exit('Database connection could not be established.');
        }
    }
    
    /*Getting MYSQL Versions. You can choose these two methods by modifying the
     *Development/Controller.php */
    
    //GET MYSQL VERSION (OBSOLETE)
    public function getMySqlVersion()
    {
        $sql = "SHOW VARIABLES LIKE '%version%'";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetchColumn();
    }
    //GET MYSQL VERSION (THE SAFEST)
    public function getMySqlVersion2()
    {
        $sql = ("SELECT VERSION()");
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->fetchColumn();
    }
    
    // **************************************************************************************
    
}
