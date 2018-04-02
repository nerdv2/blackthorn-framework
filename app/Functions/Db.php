<?php
namespace Blackthorn\Functions;

use Blackthorn\Core\Database;
class Db
{
    public function prepare($query)
    {
        $pdo = Database::getInstance()->getConnection()->prepare($query);
        return $pdo;
    }

    public function insert($table, $data)
    {
        $query = 'INSERT INTO ' . $table;
        $record = array();
        foreach ($data as $key => $value)
        {
            $record[$key] = ':' . $key;
        }
        $query .= ' (' . (implode(',', array_keys($record))) . ') VALUES(' . implode(',', array_values($record)) . ')';

        $statement = $this->prepare($query);

        foreach ($data as $key => &$value)
        {
            $statement->bindParam(':' . $key, $value);
        }
        
        return $statement->execute();
    }

    public function update($table, $data, $wherename, $whereid)
    {
        $query = 'UPDATE ' . $table;
        $update = array();
        foreach ($data as $key => $value)
        {
            $update[] = $key . '= :' . $key;
        }
        $query .= ' SET ' . (implode(',', $update));
        $query .= ' WHERE ' . $wherename . ' = :' . $wherename . PHP_EOL;

        $statement = $this->prepare($query);

        foreach ($data as $key => &$value)
        {
            $statement->bindParam(':' . $key, $value);
        }

        $statement->bindParam(':' . $wherename, $whereid);

        return $statement->execute();
    }

    public function getDataDB($field, $table, $whrfield, $iddata)
    {
        $querydata      = "select $field from $table where $whrfield = ? limit 1";
        $rundata        = $this->prepare($querydata);
        $rundata->bindParam(1, $iddata);
        $rundata->execute();
        $rowdata        = $rundata->fetch();

        return $rowdata[$field];
    }

    public function getSingleFull($table, $whrfield, $iddata)
    {
        # function getsinglefull
        $querydata      = "select * from $table where $whrfield = ? limit 1";
        $rundata        = $this->prepare($querydata);
        $rundata->bindParam(1, $iddata);
        $rundata->execute();
        $rowdata        = $rundata->fetch();
        
        return $rowdata;
    }

    public function getDataCount($table, $whrfield, $whrdata)
    {
        $querydata      = "select * from $table where $whrfield = ?";
        $rundata        = $this->prepare($querydata);
        $rundata->bindParam(1, $whrdata);
        $rundata->execute();
        $countresult    = $rundata->rowCount();
        
        return $countresult;
    }
}
