<?php

namespace Core;

class CMS
{
    protected ?Database $db = null;
    protected ?Animals $animal = null;

    public function __construct(string $dsn, ?string $username = null, ?string $password = null)
    {
        $this->db = new Database($dsn, $username, $password);
    }

    public function animals()
    {
        if ($this->animal === null) {
            $this->animal = new Animals($this->db);
        }

        return $this->animal;
    }
}