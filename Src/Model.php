<?php
/**
 * Created by PhpStorm.
 * User: Andreea
 * Date: 04-Dec-18
 * Time: 10:24
 */

namespace Framework;

use PDO;
Use App\Config;

abstract class Model
{
    protected $table;

    public Function newDbCon($resultAsArray = false)
    {
        //$config = new Config();
        $dsn = Config::DB['driver'];
        $dsn .= ":host=".Config::DB['host'];
        $dsn .= ";dbname=".Config::DB['dbname'];
        $dsn .= ";port=".Config::DB['port'];
        $dsn .= ";charset=".Config::DB['charset'];

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        //by default the result from database will be an object but if specified it can be changed to    an associative array / matrix
        if ($resultAsArray) {
            $options[PDO::ATTR_DEFAULT_FETCH_MODE] = PDO::FETCH_ASSOC;
        }

   try {
       return new PDO($dsn, Config::DB['user'], Config::DB['pass'], $options);
   } catch (\PDOException $e) {
       throw new \PDOException($e->getMessage(), (int)$e->getCode());
   }



    }

    /**
     *Return all data from table
     */
    public Function getAll(): array
    {
        $db = $this->newDbCon();
        $stmt = $db->query("SELECT * from $this->table");

        return $stmt->fetchAll();
    }

    /**
     *Return data with specified id/index
     */
    public function get($id)
    {
        $db = $this->newDbCon();
        $stmt = $db->prepare("SELECT * from $this->table where id=?");
        $stmt->execute([$id]);
        $rez = $stmt->fetch();
        return $rez;
    }

    /**
     * this function will prepare data to be used in sql statement
     * 1. Will extract values from $data
     * 2. Will create the prepared sql string with columns from $data
     */
    protected function prepareDataForStmt(array $data): array
    {
//        $columns = '';
//        $values = [];
//
//        for($i=0; $i < count($data); $i++) {
//
//            $values[]= $data[$i];
//            $columns .= "key($data) = ? ";
//         //if we are not at the last element with the iteration
//         if(count($data) < ($i + 1)) {
//             $columns .= "AND ";
//         }
//       }
//
//        return [$columns, $values];


        $columns = '';
        $values = [];

        $i=0;
        for($i=0; $i < count($data); $i++)
        {
            $param = current($data);
            $values[]= $param;
            $columns .= key($data)." = ? ";
            //if we are not at the last element with the iteration
            if(count($data) < ($i + 1)) {
                $columns .= "AND ";
            }

            next($param);
        }

        return [$columns, $values];

    }

    /**
     *Find data with values
     */
    public function find(array $data)
    {
        list($columns, $values) = $this->prepareDataForStmt($data);
        $db = $this->newDbCon();
        $stmt = $db->prepare("SELECT * from $this->table where $columns");
        return $stmt->execute([$values]);
    }

    public function getByParams(array $data){
        list($columns, $values) = $this->prepareDataForStmt($data);
        $db = $this->newDbCon();
        $stmt = $db->prepare("SELECT * from $this->table where $columns");
        $stmt->execute($values);
        $rez = $stmt->fetch();
        return $rez;
    }

    /**
     *Insert new data in table
     */
    public function new(array $data)
    {
        $values = array_values($data);
        $db = $this->newDbCon();
        $params = "?";
        for($i=0;$i<count($data)-1;$i++){
            $params.=",?";
        }
        $col = implode(",",array_keys($data));
        $stmt=$db->prepare("INSERT INTO $this->table($col) VALUES ($params)");
        $stmt->execute($values);
    }

    /**
     *Update data in table
     */
    public function update(array $data)
    {
    }

    /**
     *delete data from table
     */
    public function delete($id)
    {
    }

}
