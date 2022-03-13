<?php

namespace PhpMvc\Database\Managers;
use App\Models\BaseModel;
use PhpMvc\Database\Grammars\MysqlGrammar;
use PhpMvc\Database\Managers\Contracts\DatabaseManager;

class MysqlManager implements DatabaseManager
{
    protected static $instance;

    public function connect(): \PDO
    {
        if(!self::$instance){

            $dsn = env('DB_DRIVER') . ':host=' . env('DB_HOST')  . ';dbname=' . env('DB_NAME') . ';port=' . env('DB_PORT') . ';charset='.env('DB_CHARSET');
            self::$instance = new \PDO($dsn,env('DB_USERNAME'),env('DB_PASSWORD'));
        }
        return self::$instance;

    }


    public function query(string $query, $values = [])
    {
        $stmt = self::$instance->prepare($query);

        for ($i = 1, $iMax = count($values); $i <= $iMax; $i++) {
            $stmt->bindValue($i, $values[$i - 1]);
        }
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function read(int $page,$filter,$columns)
    {
        $query = MySQLGrammar::buildSelectQuery($page,$filter,$columns);
        $stmt = self::$instance->prepare($query);
        if ($filter) { $stmt->bindValue(1, $filter[1]); }
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, BaseModel::getModel());
    }

    public function delete($id)
    {
        $query = MySQLGrammar::buildDeleteQuery();
        $stmt = self::$instance->prepare($query);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }

    public function update($id, $data)
    {
        $query = MySQLGrammar::buildUpdateQuery(array_keys($data));
        $stmt = self::$instance->prepare($query);
        $values = array_values($data);
        foreach (array_values($data) as $i=>$value){
            $stmt->bindValue($i+1, $value);
        }
        $stmt->bindValue(count($values) + 1, $id);
        return $stmt->execute();
    }

    public function create($data)
    {
        $query = MysqlGrammar::buildInsertQuery(array_keys($data));

        $stmt = self::$instance->prepare($query);
        $values = array_values($data);
        for ($i = 1, $i <= $iMax = count($values); $i <= $iMax; $i++) {
            $stmt->bindValue($i, $values[$i - 1]);
        }
        return $stmt->execute();
    }

}