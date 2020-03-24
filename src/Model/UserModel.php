<?php
/**
 * Class TaskModel
 */
namespace Model;

use Core\Model;

class UserModel extends Model
{
    // User roles
    const ROLE = [
        'admin' => 1,
    ];

    /**
     * @return array
     */
    public function getByLogin($login)
    {
        $users = Model::table('users')->where([
            'field'         => 'login',
            'value'         => $login,
            'conditions'    => '=',
        ])->find();

        $user = [];
        if(isset($users[0])) {
            $user = $users[0];
        }

        return $user;
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

        if(!empty($errors)) {
            
            return $errors;
        }

        $user = $this->getByLogin($data['login']);
        if(empty($user)) {
            $errors['wrong_access_details'] = LANG_VALID_WRONG_ACCESS_DETAILS;

            return $errors;
        }

        if($data['password'] != $user['password']) {
            $errors['wrong_access_details'] = LANG_VALID_WRONG_ACCESS_DETAILS;
        }

        return $errors;
    }

    /**
     * @return void
     */
    public function authorization()
    {
        $_SESSION['is_auth'] = true;
    }
}