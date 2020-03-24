<?php
/**
 * Class HomeController
 */
namespace Controller;

use Exception;
use Core\Controller;
use Core\View;
use Model\TaskModel;

class HomeController extends Controller
{
    /**
     * @var TaskModel $task
     */
    private $tasks;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->tasks = new TaskModel();
    }

    /**
     * @return void
     */
    public function index()
    {
        try {
            $tasks = $this->collectionTasks();
            $messages = $this->managerFlipSession('messages');
            
            return View::render('home/index', [
                'data'      => $tasks,
                'messages'  => $messages
            ]);
        } catch(Exception $e) {

            return $e->getMessage();
        }
    }

    /**
     * @return void
     */
    public function edit()
    {
        try {
            $this->checkAccess();

            $id = $this->get('id');
            $task = [];
            $tasks = $this->collectionTasks($id);
            if(isset($tasks[0])) {
                $task = $tasks[0];
            }
            $messages = $this->managerFlipSession('messages');
            
            return View::render('home/edit', [
                'data'      => $task,
                'messages'  => $messages
            ]);
        } catch(Exception $e) {

            return $e->getMessage();
        }
    }

    /**
     * @return void
     */
    public function createAction()
    {
        try {
            $request = $this->post();
            $data = $request;
            $data['status'] = $this->tasks::STATUS['new'];

            $errors = $this->validation($data);
            if(!empty($errors)) {
                $tasks = $this->collectionTasks();
                
                return View::render('home/index', [
                    'data' => $tasks,
                    'errors' => $errors
                ]);
            }

            $this->tasks->createTask($data);
            $_SESSION['flip']['messages'] = [
                LANG_ADDED_TASK
            ];

            $this->redirect();
        } catch(Exception $e) {

            return $e->getMessage();
        }
    }

    /**
     * @return void
     */
    public function updateAction()
    {
        try {
            $this->checkAccess();

            $request = $this->post();
            $data = $request;
            $taskId = $data['id'];

            $errors = $this->validation($data);
            if(!empty($errors)) {
                $task = [];
                $tasks = $this->collectionTasks($taskId);
                if(isset($tasks[0])) {
                    $task = $tasks[0];
                }
                
                return View::render('home/edit', [
                    'data' => $task,
                    'errors' => $errors
                ]);
            }
            $taskDescription = $this->tasks->getDescriptionById($taskId);
            $data['is_admin_edit'] = 0;
            if($data['description'] !== $taskDescription) {
                $data['is_admin_edit'] = 1;
            }

            $this->tasks->updateTask($data);
            $_SESSION['flip']['messages'] = [
                LANG_UPDATED_TASK
            ];

            $this->redirect('/?page=edit&id=' . $data['id']);
        } catch(Exception $e) {

            return $e->getMessage();
        }
    }

    /**
     * @return void
     */
    public function performedAction()
    {
        try {
            $this->checkAccess();

            $request = $this->get();
            $data['id'] = $request['id'];
            $data['status'] = $this->tasks::STATUS['done'];

            $this->tasks->performedTask($data);
            $_SESSION['flip']['messages'] = [
                LANG_PERFORMER_TASK
            ];

            $this->redirect();
        } catch(Exception $e) {

            return $e->getMessage();
        }
    }

    /**
     * @return array
     */
    private function collectionTasks($id = null): array
    {
        $data = [];

        if(!empty($id)) {
            $result = $this->tasks->getById($id);
        } else {
            $result = $this->tasks->getAll();
        }
        
        if(!empty($result)) {
            $data = $this->mapping($result);
        }

        return $data;
    }

    /**
     * @param array $data
     * @return array
     */
    private function mapping($data): array
    {
        foreach($data as $key => $row) {
            // Mapping status for task
            $row['status'] = $this->tasks::MAPPING_STATUS[$row['status']];
            $row['is_admin_edit'] = $this->tasks::MAPPING_IS_ADMIN_EDIT[$row['is_admin_edit']];

            $data[$key] = $row;
        }

        return $data;
    }
}