<?php

class Database
{

    private $_connection = null;
    private static $_instance = null;


    public function __construct()
    {
        $this->Connection();
    }

    private function Connection()
    {
        $this->_connection = new PDO('mysql:host='.Config::get('database.host').';dbname='.Config::get('database.dbname').'', Config::get('database.user'), Config::get('database.password'));
        $this->_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }

    public static function Instance()
    {
        if (!isset(self::$_instance)) {
            return self::$_instance = new Database();
        }
        return self::$_instance;
    }

    public function Insert(string $tableName = '', $data = array())
    {
        if (empty($tableName) || empty($data)) throw new PDOException('table and data not set');
        $columns = implode(',', array_keys($data));
        $getColumnsValues = array_values($data);
        $setColumn = '';
        $x = 1;
        foreach ($data as $columnValue => $test) {
            $setColumn .= "?";
            if ($x < count($data)) {
                $setColumn .= ",";
            }
            $x++;
        }
        $query = "INSERT INTO {$tableName} ($columns) VALUES($setColumn)";
        $prepareStatement = $this->_connection->prepare($query);
        try {
            if ($prepareStatement->execute($getColumnsValues)) {
                return $this->_connection->lastInsertId();
            }

        } catch (PDOException $exception) {
            die($exception->getMessage());
        }

        return false;


    }

    public function Delete(string $tableName = '', $criteria = '', $bindValue = array())
    {
        if (empty($tableName) || empty($criteria) || empty($bindValue)) throw new PDOException('there was a problems');
        $query = "DELETE FROM {$tableName} WHERE {$criteria}";
        $prepareStatement = $this->_connection->prepare($query);
        try {
            if ($prepareStatement->execute($bindValue)) {
                return true;
            }

        } catch (PDOException $exception) {
            die($exception);
        }

        return false;

    }

    public function Update($tableName = '', $data = array(), $criteria = '', $dbValue = array())
    {
        if (empty($tableName) || empty($data) || empty($criteria) || empty($dbValue)) throw new PDOException('errors');
        $mergeValue = array_merge(array_values($data), $dbValue);
        $x = 1;
        $setColumns = '';
        foreach ($data as $columns => $dataValue) {
            $setColumns .= "{$columns}=?";
            if ($x < count($data)) {
                $setColumns .= ", ";
            }
            $x++;
        }

        $query = "UPDATE {$tableName} SET {$setColumns} WHERE {$criteria}";
        $prepareStatement = $this->_connection->prepare($query);
        try {
            if ($prepareStatement->execute($mergeValue)) {
                return true;
            }

        } catch (PDOException $exception) {
            die($exception);
        }

        return false;


    }

    public function Select($tableName = '', $columns = '*', $criteria = '', $bindValue = array(), $clause = '')
    {
        if (empty($tableName) || empty($columns)) throw new PDOException('errors');
        $query = "SELECT {$columns} FROM {$tableName}";
        if (!empty($criteria)) {
            $query .= " WHERE {$criteria}";
        }

        if (!empty($clause)) {
            $query .= " " . $clause;
        }




        $prepareStatement = $this->_connection->prepare($query);
        try {
            $prepareStatement->execute($bindValue);
            return $prepareStatement->fetchALL(PDO::FETCH_CLASS);

        } catch (PDOException $exception) {
            die($exception);
        }

    }

    public function Count($tableName = '', $criteria = '', $bindValue = array())
    {
        if (empty($tableName)) throw new PDOException('errors');
        $query = "SELECT COUNT(*) COUNT FROM {$tableName}";
        if (isset($criteria) && $bindValue) {
            $query .= " WHERE {$criteria}";
        }

        $prepareStatement = $this->_connection->prepare($query);
        try {
            $prepareStatement->execute($bindValue);
            $result = $prepareStatement->fetchALL(PDO::FETCH_COLUMN);
            if ($result) {
                return $result[0];
            }

            return $result;

        } catch (PDOException $exception) {
            die($exception);
        }

    }

}

