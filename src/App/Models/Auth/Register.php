<?php

namespace App\Models\Auth;

use Core\Database;

class Register
{
    protected Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function create(string $email, string $password): bool
    {
        try {
            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO users (email, password_hash)
                    VALUES (:email, :password_hash)";
            $this->db->executeSQL($sql, [$email, $password_hash]);
            return true;
        } catch (\PDOException $e) {
            if ($e->errorInfo[1] === 1062) {
                return false;
            }
            throw $e;
        }
    }
}