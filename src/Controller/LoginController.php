<?php
/**
 * Class HomeController
 */
namespace Controller;

use Exception;
use Core\Controller;
use Core\View;
use Model\UserModel;

class LoginController extends Controller
{
    /**
     * @var UserModel $user
     */
    private $user;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->user = new UserModel();
    }

    /**
     * @return void
     */
    public function index()
    {
        try {
            
            return View::render('login/index');
        } catch(Exception $e) {

            return $e->getMessage();
        }
    }

    /**
     * @return void
     */
    public function authentication()
    {
        try {
            $request = $this->post();
            $data['login'] = $request['login'];
            $data['password'] = md5($request['password']);
            
            $errors = $this->user->validation($data);
            if(!empty($errors)) {
                                
                return View::render('login/index', [
                    'errors' => $errors
                ]);
            }

            $this->user->authorization();

            $this->redirect();
        } catch(Exception $e) {

            return $e->getMessage();
        }
    }

    /**
     * @return void
     */
    public function logout()
    {
        try {
            $this->emptySession('is_auth');

            $this->redirect();
        } catch(Exception $e) {

            return $e->getMessage();
        }
    }
}