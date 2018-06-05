<?php

class Model
{
    protected $tableName, $columns, $primaryKey, $orderBy;

    private $_db = null;

    public function __construct()
    {
        $this->_db = Database::Instance();
    }

    public function Save($data = array(), $criteria = '')
    {
        if (empty($data)) throw new PDOException('data not set');
        if (empty($criteria)) {
            return $this->_db->Insert($this->tableName, $data);
        }
        return $this->_db->Update($this->tableName, $data, $this->primaryKey, array($criteria));

    }


    public function getData($criteria = '')
    {
        if (empty($criteria)) {
            return $this->_db->Select($this->tableName, $this->columns, '', array(), ' ORDER BY ' . $this->orderBy . ' DESC');
        }

        return $this->_db->Select($this->tableName, $this->columns, $this->primaryKey, array($criteria));


    }

    public function getByCriteria($criteria = '')
    {
        if (empty($criteria)) return false;
        $result = $this->_db->Select($this->tableName, $this->columns, $this->primaryKey, array($criteria));
        if ($result) {
            return $result[0];
        }
        return $result;

    }

    public function Delete($criteria = '')
    {
        if (empty($criteria)) return false;
        return $this->_db->Delete($this->tableName, $this->primaryKey, array($criteria));

    }

    public function getBy($criteria = '', $data = array())
    {
        if (empty($criteria)) return false;
        $result = $this->_db->Select($this->tableName, $this->columns, $criteria . '=? AND status=1', array($data));
        if (empty($result)) return $result;

        if ($result) {
            return $result[0];
        }

        return $result;
    }


}