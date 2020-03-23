<?php
/**
 * Class Model
 */
namespace Core;

use Exception;
use PDO;

class Model
{
    /**
     * @var PDO $dbh
     */
    private $dbh;

    /**
     * @var string $sql
     */
    private $sql = '';

    /**
     * @var string $table
     */
    private $table;

    /**
     * @var string $fields
     */
    private $fields;

    /**
     * @var string $join
     */
    private $join = '';

    /**
     * @var string $leftJoin
     */
    private $leftJoin = '';

    /**
     * @var string $groupBy
     */
    private $groupBy = '';

    /**
     * @var string $limit
     */
    private $limit;

    /**
     * @var string $offset
     */
    private $offset;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        if(!$this->dbh) {
            $this->connect();
        }
    }

    /**
     * @return void
     */
    private function connect()
    {
        $this->dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.'', DB_USER, DB_PASSWORD);
        $this->dbh->exec("set names ".DB_CHARSET);
    }

    /**
     * @param string $table
     * @return Model
     */
    public static function table($table)
    {
        $orm = new Model();
        $orm->table = $table;
        $orm->sql = 'SELECT '. '*'
            .' FROM '. $orm->table;

        return $orm;
    }

    /**
     * @param array $fields
     * @return $this
     */
    public function fields($fields)
    {
        $this->fields = implode(',', $fields);
        $this->sql = 'SELECT '. $this->fields
            .' FROM '. $this->table;

        return $this;
    }

    /**
     * @param $tables
     * @param $conditions
     * @return $this
     */
    public function join($tables, $conditions)
    {
        $join = '';
        for ($i = 0; $i < count($tables); $i++) {
            $join .= ' JOIN ' . $tables[$i] . ' ON ' . $conditions[$i];
        }
        $this->join = $join;

        return $this;
    }

    /**
     * @param $table
     * @param $condition
     * @return $this
     */
    public function leftJoin($table, $condition)
    {
        $this->leftJoin = ' LEFT JOIN ' . $table . ' ON ' . $condition;

        return $this;
    }

    /**
     * @param $groupBy
     * @return $this
     */
    public function groupBy($groupBy)
    {
        $this->groupBy = ' GROUP BY ' . implode(',', $groupBy);
        $this->sql = 'SELECT '. $this->fields
            .' FROM '. $this->table
            . $this->leftJoin
            . $this->join
            . $this->groupBy;

        return $this;
    }

    /**
     * @param $limit
     * @return $this
     */
    public function limit($limit)
    {
        $this->limit = $limit;
        $this->sql = 'SELECT '. $this->fields
            .' FROM '. $this->table
            . $this->leftJoin
            . $this->join
            . $this->groupBy
            . ' LIMIT '. $this->limit;

        return $this;
    }

    /**
     * @param $offset
     * @return $this
     */
    public function offset($offset)
    {
        $this->offset = $offset;
        $this->sql = 'SELECT '. $this->fields
            .' FROM '. $this->table
            . $this->leftJoin
            . $this->join
            . $this->groupBy
            . ' LIMIT '. $this->limit
            . ' OFFSET '. $this->offset;

        return $this;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function find()
    {
        try {
            $sth = $this->dbh->prepare($this->sql);
            if($sth->execute()) {

                return $sth->fetchAll(PDO::FETCH_ASSOC);
            }

            return false;
        } catch (Exception $e) {

            throw new Exception('Failed to select data');
        }
    }

    /**
     * sqlClean destruct.
     */
    public function __destruct()
    {
        $this->dbh = null;
        $this->sql = '';
        $this->table = null;
        $this->fields = null;
        $this->limit = null;
        $this->offset = null;
    }

}
