<?php
/**
 * Class TaskModel
 */
namespace Model;

use Core\Model;

class TaskModel extends Model
{
    /**
     * Statuses mapping
     */
    const MAPPING_STATUS = [
        1 => LANG_STATUS_NEW,
        2 => LANG_STATUS_IN_PROGRESS,
        3 => LANG_STATUS_DONE,
    ];

    /**
     * @return void
     */
    public function getAll()
    {
        return Model::table('tasks')->find();
    }
}