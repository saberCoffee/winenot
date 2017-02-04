<?php
namespace Model;

use \W\Model\UsersModel;
use \W\Security\AuthentificationModel;
use Model\TokenModel;

class UserModel extends UsersModel
{

	public function register($email, $password, &$error)
	{
		if ($this->emailExists($email)) {
			$error['email'] = 'Cette adresse email est déjà enregistrée.';
			return;
		}

		$auth = new AuthentificationModel;
		$validation = new AuthentificationModel;

		$hashedPassword = $auth->hashPassword($password);

		$id =  md5(uniqid(rand(), true));

		$data = array(
				'id'       => $id,
				'email'    => $email,
				'password' => $hashedPassword
		);

		$this->insert($data);

		$classToken = new TokenModel();
		$token = $classToken->generateToken($id);
		$validation->logUserIn($user, $token);
		return $token;
	}

	public function login($email, $password, &$error)
	{
		$validation = new AuthentificationModel;

		$user_id = $validation->isValidLoginInfo($email, $password);

		if (!$user_id) {
			$error['login_email'] = 'Votre identifiant ou mot de passe ne sont pas corrects.';
		} else {
				
			$classToken = new TokenModel();
			$token = $classToken->generateToken($id);
			 
			$user = $this->find($user_id);

			$validation->logUserIn($user, $token);
			return $token;


		}
	}


}

