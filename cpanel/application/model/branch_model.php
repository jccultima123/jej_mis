<?php

class AssetModel
{
    public function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            header('Location: _fb/database.html');
            exit();
        }
    }
}
