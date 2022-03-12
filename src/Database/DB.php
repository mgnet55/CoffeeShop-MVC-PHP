<?php

namespace PhpMvc\Database;

use PhpMvc\Database\Concerns\ConnectsTo;
use PhpMvc\Database\Managers\Contracts\DatabaseManager;

class DB
{
    protected DatabaseManager $manager;

    public function __construct(DatabaseManager $manager)
    {
        $this->manager = $manager;
    }

    public function init()
    {
        ConnectsTo::connect($this->manager);
    }

    protected function raw(string $query, $value = [])
    {
        return $this->manager->query($query, $value);
    }

    protected function delete($id)
    {
        return $this->manager->delete($id);
    }

    protected function create(array $data)
    {
        return $this->manager->create($data);
    }

    protected function update($id, array $attributes)
    {
        return $this->manager->update($id, $attributes);
    }

    protected function read(int $page,$filter, $columns)
    {
        return $this->manager->read($page,$filter, $columns);
    }

    public function __call(string $name, array $arguments)
    {
        if (method_exists($this, $name)) {
            return call_user_func_array([$this, $name], $arguments);
        }
    }

}