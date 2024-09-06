<?php

namespace src;

use PDO;

class QueryBuilder
{

    protected $pdo;
    protected $table;
    protected $columns = '*';
    protected $where = [];
    protected $orderBy = '';
    protected $limit = '';

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    public function select($columns = '*')
    {
        $this->columns = $columns;
        return $this;
    }

    public function where($column, $operator, $value)
    {
        $this->where[] = "$column $operator '$value'";
        return $this;
    }

    public function orderBy($column, $direction = 'ASC')
    {
        $this->orderBy = "ORDER BY $column $direction";
        return $this;
    }

    public function limit($limit)
    {
        $this->limit = "LIMIT $limit";
        return $this;
    }

    public function get()
    {
        $query = "SELECT {$this->columns} FROM {$this->table}";

        if (!empty($this->where)) {
            $query .= " WHERE " . implode(' AND ', $this->where);
        }

        if (!empty($this->orderBy)) {
            $query .= " " . $this->orderBy;
        }

        if (!empty($this->limit)) {
            $query .= " " . $this->limit;
        }

//        var_dump($query);
//        die();

        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
}