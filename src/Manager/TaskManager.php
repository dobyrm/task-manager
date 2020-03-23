<?php
/**
 * Class TaskManager
 */
namespace Manager;

use Exception;
use Form\TaskForm;
use Services\Template;
use Services\Request;
use Repository\TaskRepository;

class TaskManager
{
    /**
     * @var [object] $taskRepository
     */
    private $taskRepository;

    /**
     * @var [object] $request
     */
    private $request;

    /**
     * Construct for TaskManager
     */
    public function __construct()
    {
        $this->taskRepository = new TaskRepository();
        $this->request = new Request();
    }

    /**
     * Render template by name template
     */
    public function index()
    {
        try {
            $taskForm = new TaskForm();

            $fields = $taskForm->buildForm();

            return Template::render('TaskForm', $fields);
        } catch(Exception $e) {

            throw new Exception("Form does not exist");
        }
    }
}