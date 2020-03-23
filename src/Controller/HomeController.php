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
            $data = [];

            $result = $this->tasks->getAll();
            if(!empty($result)) {
                $data = $this->mapping($result);
            }

            return View::render('home/index', $data);
        } catch(Exception $e) {

            return $e->getMessage();
        }
    }

    /**
     * @param array $data
     * @return void
     */
    private function mapping($data): array
    {
        foreach($data as $key => $row) {
            // Mapping status for task
            $row['status'] = $this->tasks::MAPPING_STATUS[$row['status']];

            $data[$key] = $row;
        }

        return $data;
    }
}