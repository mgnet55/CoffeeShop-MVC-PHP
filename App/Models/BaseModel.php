<?php
namespace App\Models;

abstract class BaseModel
{
    protected static $instance;

    public static function create(array $attributes)
    {
        self::$instance = static::class;
        return app()->db->create($attributes);
    }
    public static function update($id, array $attributes)
    {
        self::$instance = static::class;
        return app()->db->update($id, $attributes);
    }
    public static function delete($id)
    {
        self::$instance = static::class;
        return app()->db->delete($id);
    }

    public static function all ($page)
    {
        self::$instance=static::class;
        return app()->db->read($page,null,'*');
    }

    public static function where($page,$filter,$columns='*'){
        self::$instance=static::class;
        dump( static::class);
        return app()->db->read($page,$filter,$columns);
    }

    public static function getModel(){
        return self::$instance;
    }

    public static function getTableName(){
        return self::$instance::$tableName;
        //return Str::lower(Str::plural(classBaseName(self::$instance)));
    }

}