<?php

namespace Core;

class Animals
{
    protected ?Database $db = null;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM animals";
        return $this->db->executeSQL($sql)->fetchAll();
    }
}