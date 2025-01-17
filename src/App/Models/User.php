<?php
declare(strict_types=1);

namespace App\Models;

use Core\Database;

class User
{
    protected Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM users";
        return $this->db->executeSQL($sql)->fetchAll();
    }

    public function getById(int $id): mixed
    {
        $sql = "SELECT first_name, last_name FROM users WHERE id = :id";
        return $this->db->executeSQL($sql, [$id])->fetch();
    }
}