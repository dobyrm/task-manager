<?php
/**
 * Class Controller
 */
namespace Core;

class Controller
{
    /**
     * @param array $index
     * @return void
     */
    public function get($index = null)
    {
        $params = [];
        $get = $_GET;
        if(empty($get)) {

            return $params;
        }
        if(!empty($index)) {

            if(isset($get[$index])) {

                return $get[$index];
            }
        }

        foreach($get as $key => $val) {
            $params[$key] = $val;
        }

        return $params;

    }

    /**
     * @param array $index
     * @return void
     */
    public function post($index = null)
    {
        $params = [];
        $post = $_POST;
        if(empty($post)) {

            return $params;
        }
        if(!empty($index)) {

            if(isset($post[$index])) {

                return htmlspecialchars($post[$index]);
            }
        }

        foreach($post as $key => $val) {
            $params[$key] = htmlspecialchars($val);
        }

        return $params;

    }

    /**
     * @param array $data
     * @return void
     */
    public function validation($data)
    {
        $errors = [];

        foreach($data as $key => $val) {
            if(empty($val)) {
                $errors[$key] = $key . ' ' . LANG_VALID_EMPTY;
            }
        }

        if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = LANG_VALID_EMAIL_FORMAT_INVALID;
        }

        return $errors;
    }

    /**
     * @param string $route
     * @return void
     */
    public function redirect($route = '/')
    {
        header("Location: " . $route); 
        exit();
    }

    /**
     * @param string $key
     * @return void
     */
    public function emptySession($key)
    {
        if(isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * @param string $key
     * @return array
     */
    public function managerFlipSession($key)
    {
        $messages = [];
        if(!empty($_SESSION['flip'])) {
            $messages = $_SESSION['flip'][$key];
            $this->emptySession('flip');
        }

        return $messages;
    }

    /**
     * @return void
     */
    public function checkAccess()
    {
        if(!(isset($_SESSION['is_auth'])) && ($_SESSION['is_auth'] !== true)) {

            $this->redirect();
        }
    }
}