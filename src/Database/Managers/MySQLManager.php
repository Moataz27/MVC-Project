<?php

namespace Trinto\Database\Managers;

use App\Models\Model;
use Trinto\Database\Grammars\MySQLGrammar;
use Trinto\Database\Managers\Contracts\DatabaseManager;

class MySQLManager implements DatabaseManager
{
    protected static $instance;

    public function connect(): \PDO
    {
        if (!self::$instance) {
            self::$instance = new \PDO(
                env('DB_DRIVER') . ":host=" . env('DB_HOST') . ";dbname=" . env('DB_DATABASE'),
                env('DB_USERNAME'),
                env('DB_PASSWORD')
            );
        }

        return self::$instance;
    }

    public function query(string $query, $values = [])
    {
        $stm = self::$instance->prepare($query);

        foreach($values as $index => $value){
            $stm->bindValue($index + 1, $value);
        }

        $stm->execute();

        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = MySQLGrammar::buildInsertQuery(array_keys($data));

        $stm = self::$instance->prepare($query);

        foreach(array_values($data) as $index => $value){
            $stm->bindValue($index + 1, $value);
        }

        return $stm->execute();

    }

    public function read($columns = '*', $filter = null)
    {
        $query = MySQLGrammar::buildSelectQuery($columns, $filter);

        $stm = self::$instance->prepare($query);

        if($filter){
            $stm->bindValue(1, $filter[2]);
        }

        $stm->execute();

        return $stm->fetchAll(\PDO::FETCH_CLASS, Model::getModel());
    }

    public function update($id, $data)
    {
        $query = MySQLGrammar::buildUpdateQuery(array_keys($data));

        $stm = self::$instance->prepare($query);

        foreach(array_values($data) as $index => $value){
            $stm->bindValue($index + 1, $value);

            if($index == count(array_values($data)) - 1){
                $stm->bindValue($index + 2, $id);
            }
        }

        return $stm->execute();
    }

    public function delete($id)
    {
        $query = MySQLGrammar::buildDeleteQuery();

        $stm = self::$instance->prepare($query);

        $stm->bindValue(1 ,$id);

        return $stm->execute();
    }
}
