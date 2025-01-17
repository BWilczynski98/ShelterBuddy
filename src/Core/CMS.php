<?php
declare(strict_types=1);

namespace Core;

class CMS
{
    protected ?Database $db = null;
    protected ?Animals $animal = null;
    protected array $models = [];

    public function __construct(string $dsn, ?string $username = null, ?string $password = null)
    {
        $this->db = new Database($dsn, $username, $password);
    }

    public function getModel(string $model_class)
    {
        if (!isset($this->models[$model_class])) {
            $this->models[$model_class] = new $model_class($this->db);
        }

        return $this->models[$model_class];
    }
}