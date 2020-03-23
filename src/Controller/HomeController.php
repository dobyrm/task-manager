<?php
/**
 * Class ControllerForm
 */
namespace Controller;

use Exception;
use Manager\TaskManager;

class HomeController
{
    /**
     * @var [object] $taskManager
     */
    private $taskManager;
    
    /**
     * Construct HomeController
     */
    public function __construct()
    {
        $this->taskManager = new TaskManager();
    }

    /**
     * Render template by name template
     */
    public function index()
    {
        try {
            
            return $this->taskManager->index();
        } catch(Exception $e) {

            return $e->getMessage();
        }
    }
}