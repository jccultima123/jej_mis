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
}
