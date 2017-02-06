<?php
namespace Model;

use \W\Model\UsersModel;
use \W\Security\AuthentificationModel;
use Model\TokenModel;

class UserModel extends UsersModel
{
	/**
	 * Cette fonction ajoute un utilisateur à la base de données si aucune erreur n'a été rencontrée lors du processus de validation.
	 * Avant de conclure l'inscription, on génère un nouveau token lié à l'utilisateur.
	 *
	 * @param $email string L'email de l'utilisateur
	 * @param $password string le mot de passe de l'utilisateur
	 * @param $firstname string Le prénom de l'utilisateur
	 * @param $firstname string Le nom de famille de l'utilisateur
	 * @param &$error L'array contenant les potentielles erreurs rencontrées à la validation du formulaire
	 *
	 * return @string $token Le token créé à l'inscription
	 */
	public function register($email, $password, $firstname, $lastname, &$error)
	{
		if ($this->emailExists($email)) {
			$error['register_email'] = 'Cette adresse email est déjà enregistrée.';
			return;
		}

		$auth = new AuthentificationModel;

		$hashedPassword = $auth->hashPassword($password);

		$id =  md5(uniqid(rand(), true));

		$data = array(
			'id'        => $id,
			'email'     => $email,
			'password'  => $hashedPassword,
			'firstname' => $firstname,
			'lastname'  => $lastname
		);

		$this->insert($data);

		$classToken = new TokenModel();
		$token = $classToken->generateToken($id);

		$user = $this->find($id);

		$auth->logUserIn($user, $token);
		return $token;
	}

	/**
	 *
	 */
	public function login($email, $password, &$error)
	{
		$auth = new AuthentificationModel;

		$user_id = $auth->isValidLoginInfo($email, $password);

		if (!$user_id) {
			$error['login_email'] = 'Votre identifiant ou mot de passe ne sont pas corrects.';
		} else {
			$classToken = new TokenModel();

			$token = $classToken->generateToken($user_id);

			$user = $this->find($user_id);

			$auth->logUserIn($user, $token);
			return $token;
		}
	}

	/**
	 *
	 */
	public function logout()
	{
		$auth = new AuthentificationModel;

		$auth->logUserOut();
	}
	
	public function members() {
		
		$members = new UserModel();
		$members = $members->findAll();
		
		if(isset($_GET['id'])){
			$member = new UserModel();
			$member = $member->find($_GET['id']);
				
		}
	}

}
