<?php
namespace Model;

use \W\Model\UsersModel;
use \W\Security\AuthentificationModel;

use \Model\TokenModel;

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

		$auth_token = $classToken->generateToken($id);
		$mp_token   = $classToken->generateToken($id, 'MP');

		$user = $this->find($id);

		$auth->logUserIn($user, $auth_token);
		return $auth_token;
	}

	/**
	 * Cette fonction réservée aux administrateur permet d'ajoutera un utilisateur à la BDD
	 * si aucune erreur n'a été rencontrée lors du processus de validation.
	 * Seuls le nom, le prénom, l'email, et le password sont obligatoire.
	 *
	 * @param $email string L'email de l'utilisateur
	 * @param $password string le mot de passe de l'utilisateur
	 * @param $firstname string Le prénom de l'utilisateur
	 * @param $firstname string Le nom de famille de l'utilisateur
	 * @param &$error L'array contenant les potentielles erreurs rencontrées à la validation du formulaire
	 *
	 */
	public function registerFromAdmin($email, $password, $firstname, $lastname, $address, $city, $postcode, $role, $error)
	{
		if ($this->emailExists($email)) {
			$error['email'] = 'Cette adresse email est déjà enregistrée.';
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
			'lastname'  => $lastname,
			'address'	=> $address,
			'city'		=> $city,
			'postcode'	=> $postcode,
			'role'		=> $role,
		);

		$this->insert($data);

		$classToken = new TokenModel();

		$mp_token   = $classToken->generateToken($id, 'MP');

		$user = $this->find($id);
	}

	/**
	 * [updateProfile description]
	 * @param  [type] $email     [description]
	 * @param  [type] $password  [description]
	 * @param  [type] $firstname [description]
	 * @param  [type] $lastname  [description]
	 * @param  [type] $address   [description]
	 * @param  [type] $city      [description]
	 * @param  [type] $postcode  [description]
	 * @param  [type] $role      [description]
	 * @param  [type] $error     [description]
	 *
	 * @return [type]            [description]
	 */
	public function updateProfile($token, $email, $password, $firstname, $lastname, $address, $postcode, $city, $role, $error)
	{
		$user = $this->getUserByToken($token);

		if ($this->emailExists($email)) {
			$email_owner = $this->getUserByUsernameOrEmail($email);

			if ($user['id'] != $email_owner['id']) {
				$error['email'] = 'Cette adresse email est déjà enregistrée.';
				return;
			}
		}

		$auth = new AuthentificationModel;

		$data = array(
			'email'    => $email,
			'address'  => $address,
			'city'     => $city,
			'postcode' => $postcode
		);

		if (!empty($password)) {
			$hashedPassword = $auth->hashPassword($password);

			$data['password'] = $hashedPassword;
		}

		if (!empty($firstname)) {
			$data['firstname'] = $firstname;
		}

		if (!empty($lastname)) {
			$data['lastname'] = $lastname;
		}

		if (!empty($role)) {
			$data['role'] = $role;
		}

		$this->update($data, $user['id']);
		$auth->refreshUser();
	}

	/**
	 * Cette fonction récupère tous les membres dont le rôle est 1 (les administrateurs)
	 *
	 * @return $array Tableau contenant toutes les informations des utilisateurs admin
	 */
	public function getAllAdmins()
	{
		$sql = "SELECT * FROM users WHERE role = 'admin'";

		$sth = $this->dbh->prepare($sql);
		$sth->execute();

		return $sth->fetchAll();
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
		$auth  = new AuthentificationModel();
		$token = new TokenModel();

		$auth->logUserOut(); // Puis on déconnecte l'utilisateur
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
