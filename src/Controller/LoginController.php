<?php
/**
 * Class LoginController
 */
namespace Controller;

use Exception;
use Manager\LoginManager;

class LoginController
{
    /**
     * @var [object] $loginManager
     */
    private $loginManager;
    
    /**
     * Construct HomeController
     */
    public function __construct()
    {
        $this->loginManager = new LoginManager();
    }

    /**
     * Render template by name template
     */
    public function index()
    {
        try {
            
            return $this->loginManager->index();
        } catch(Exception $e) {

            return $e->getMessage();
        }
    }
}