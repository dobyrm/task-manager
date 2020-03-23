<?php
/**
 * Class LoginManager
 */
namespace Manager;

use Exception;
use Form\LoginForm;
use Services\Template;
use Services\Request;

class LoginManager
{
    /**
     * @var [object] $request
     */
    private $request;

    /**
     * Construct for TaskManager
     */
    public function __construct()
    {
        $this->request = new Request();
    }

    /**
     * Render template by name template
     */
    public function index()
    {
        try {
            $loginForm = new LoginForm();
            $fields = $loginForm->buildForm();

            return Template::render('LoginForm', $fields);
        } catch(Exception $e) {

            throw new Exception("Form does not exist");
        }
    }
}