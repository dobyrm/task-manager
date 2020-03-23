<?php
/**
 * Class TaskRepository
 */
namespace Repository;

use Exception;
use Services\DB;

class TaskRepository
{
    /**
     * @var [object] $DB
     */
    private $DB;

    /**
     * Construct for TaskRepository
     */
    public function __construct()
    {
        $this->DB = new DB();
    }
}