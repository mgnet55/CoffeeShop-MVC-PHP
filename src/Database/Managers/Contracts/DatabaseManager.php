<?php

namespace PhpMvc\Database\Managers\Contracts;

interface DatabaseManager
{

    public function connect(): \PDO;

    public function query (string $query,$values=[]);

    public function create (array $data);

    public function read (int $page,$filter,$columns);

    public function update (int $id,array $data);

    public function delete (int $id);

}