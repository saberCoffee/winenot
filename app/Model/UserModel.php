<?php
namespace Model;

use \W\Model\UsersModel;
use \W\Security\AuthentificationModel;

class UserModel extends UsersModel
{

    public function register($email, $password, &$error)
    {
        if ($this->emailExists($email)) {
            $error['email'] = 'Cette adresse email est déjà enregistrée.';
            return;
        }

        $auth = new AuthentificationModel;

        $hashedPassword = $auth->hashPassword($password);

        $data = array(
            'id'       => md5(uniqid(rand(), true)),
            'email'    => $email,
            'password' => $hashedPassword
        );

        return $this->insert($data);
    }
    
        public function login($email, $password, &$error)
    {   
        $validation = new AuthentificationModel;
        
        if ($validation->isValidLoginInfo($email, $password) == 0) {
            
            $error['login_email'] = 'Votre identifiant ou mot de passe ne sont pas corrects.';
            $error['login_password'] = 'Votre identifiant ou mot de passe ne sont pas corrects.';

        } elseif ($validation->isValidLoginInfo($email, $plainPassword) == $email) {
            
            $data = $this->find($id);
            
            $validation->logUserIn($data);
        }
    }


}
