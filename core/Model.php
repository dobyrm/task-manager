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
     * @var string $where
     */
    private $where = '';

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
        $model = new Model();
        $model->table = $table;
        $model->sql = 'SELECT '. '*'
            .' FROM '. $model->table;

        return $model;
    }

    /**
     * @param array $data
     * @return void
     */
    public function where($data)
    {
        $this->sql = 'SELECT '. '*'
            . ' FROM '. $this->table
            . ' WHERE '. $data['field'] . $data['conditions'] . "'" . $data['value'] ."'";

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
     * @param string $sql
     * @param array $data
     * @return void
     */
    public function insert($sql, $data)
    {
        try {
            $sth= $this->dbh->prepare($sql);
            if($sth->execute($data)) {
                
                return true;
            }

            return false;
        } catch (Exception $e) {

            throw new Exception('Failed to set data');
        }
    }

    /**
     * @param string $sql
     * @param array $data
     * @return void
     */
    public function update($sql, $data)
    {
        try {
            $sth= $this->dbh->prepare($sql);
            if($sth->execute($data)) {

                return true;
            }

            return false;
        } catch (Exception $e) {

            throw new Exception('Failed to update data');
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
