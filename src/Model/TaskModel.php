<?php
/**
 * Class TaskModel
 */
namespace Model;

use Core\Model;

class TaskModel extends Model
{
    // Task statuses
    const STATUS = [
        'new'           => 1,
        'in_progress'   => 2,
        'done'          => 3,
    ];

    /**
     * Statuses mapping
     */
    const MAPPING_STATUS = [
        1 => LANG_STATUS_NEW,
        2 => LANG_STATUS_IN_PROGRESS,
        3 => LANG_STATUS_DONE,
    ];

    /**
     * Admin edit task mapping
     */
    const MAPPING_IS_ADMIN_EDIT = [
        0 => '',
        1 => LANG_IS_ADMIN_EDIT,
    ];

    /**
     * @return void
     */
    public function getAll()
    {
        return Model::table('tasks')->find();
    }

    /**
     * @return void
     */
    public function getById($id)
    {
        return Model::table('tasks')->where([
            'field'         => 'id',
            'value'         => $id,
            'conditions'    => '=',
        ])->find();
    }

    /**
     * @return string
     */
    public function getDescriptionById($id)
    {
        $tasks = Model::table('tasks')->where([
            'field'         => 'id',
            'value'         => $id,
            'conditions'    => '=',
        ])->find();

        $description = '';
        if(isset($tasks[0])) {
            $description = $tasks[0]['description'];
        }

        return $description;
    }

    /**
     * @param array $data
     * @return void
     */
    public function createTask($data)
    {
        $sql = "INSERT INTO tasks (name, email, status, description) VALUES (:name, :email, :status, :description)";
        $this->insert($sql, $data);
    }

    /**
     * @param array $data
     * @return void
     */
    public function updateTask($data)
    {
        $sql = "UPDATE tasks SET name=:name, email=:email, status=:status, description=:description, is_admin_edit=:is_admin_edit WHERE id=:id";
        $this->update($sql, $data);
    }

    /**
     * @param array $data
     * @return void
     */
    public function performedTask($data)
    {
        $sql = "UPDATE tasks SET status=:status WHERE id=:id";
        $this->update($sql, $data);
    }
}