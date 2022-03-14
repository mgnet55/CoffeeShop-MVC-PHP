<?php

namespace PhpMvc\Database\Grammars;

use App\Models\BaseModel;
use JetBrains\PhpStorm\Pure;
class MysqlGrammar
{
    #[Pure] public static function buildInsertQuery($keys): string
    {
        $values = '';
        for ($i = 0, $iMax = count($keys); $i < $iMax; $i++) {
            $values .= '?, ';
        }
        return 'INSERT INTO ' . BaseModel::getTableName() . ' (`' . implode('`, `', $keys) . '`) VALUES(' . rtrim($values, ', ') . ')';
    }

    #[Pure] public static function buildUpdateQuery($keys): string
    {
        $query = 'UPDATE ' . BaseModel::getTableName() . ' SET ';

        foreach ($keys as $key) {
            $query .= "{$key} = ?, ";
        }
        return rtrim($query, ', ') . ' WHERE ID = ?';
    }

    public static function buildSelectQuery(int $page ,$filter,$columns): string
    {
        if (is_array($columns)) {$columns = ' (`'.implode('`, `', $columns).'`) ';}
        $query = "SELECT {$columns} FROM " . BaseModel::getTableName() ;
        if ($filter) {$query .= " WHERE {$filter[0]} ?";}
        $query.=" LIMIT ".env('DB_PER_PAGE'). " OFFSET ".env('DB_PER_PAGE')*($page-1);
        return $query;
    }

    #[Pure] public static function buildDeleteQuery(): string
    {
        return 'DELETE FROM ' . BaseModel::getTableName() . ' WHERE id = ?';
    }
}
