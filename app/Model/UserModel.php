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
	 * @param string     $email        L'email de l'utilisateur
	 * @param string     $password     le mot de passe de l'utilisateur
	 * @param string     $firstname    Le prénom de l'utilisateur
	 * @param string     $firstname    Le nom de famille de l'utilisateur
	 * @param array      $error        Un tableau contenant les erreurs potentielles rencontrées à la validation du formulaire
	 *
	 * @return string $token Le token créé à l'inscription
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

		$tokenModel = new TokenModel();

		$auth_token = $tokenModel->generateToken($id);
		$mp_token   = $tokenModel->generateToken($id, 'MP');

		$user = $this->find($id);

		$auth->logUserIn($user, $auth_token);
		return $auth_token;
	}

	/**
	 * Cette fonction réservée aux administrateur permet d'ajoutera un utilisateur à la BDD si aucune erreur n'a été rencontrée lors du processus de validation.
	 * Seuls le nom, le prénom, l'email, et le password sont obligatoire.
	 *
	 * @param string   $email         L'email de l'utilisateur
	 * @param string   $password      le mot de passe de l'utilisateur
	 * @param string   $firstname     Le prénom de l'utilisateur
	 * @param string   $firstname     Le nom de famille de l'utilisateur
	 * @param array    $error         L'array contenant les potentielles erreurs rencontrées à la validation du formulaire
	 *
	 */
	public function registerFromAdmin($email, $password, $firstname, $lastname, $address, $city, $postcode, $role, &$error)
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

		$tokenModel = new TokenModel();

		$auth_token = $tokenModel->generateToken($id);
		$mp_token   = $tokenModel->generateToken($id, 'MP');

		$user = $this->find($id);
	}

	/**
	 * Modifie un profil utilisateur
	 *
	 * @param string     $email        L'email de l'utilisateur
	 * @param string     $password     le mot de passe de l'utilisateur
	 * @param string     $firstname    Le prénom de l'utilisateur
	 * @param string     $firstname    Le nom de famille de l'utilisateur
	 * @param string     $address      L'adresse du lieu de travail du producteur
	 * @param int        $postcode     Le code postal du lieu de travail du producteur
	 * @param string     $city         La ville du lieu de travail du producteur
	 * @param string     $role         Le rôle de l'utilisateur (user ou admin)
	 * @param array      $error        Un tableau contenant les erreurs potentielles rencontrées à la validation du formulaire
	 *
	 * @return void
	 */
	public function updateProfile($token, $email, $password, $firstname, $lastname, $address, $postcode, $city, $role, $photo, &$error)
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
			'postcode' => $postcode,
		);

		if (!empty($photo)) { // Si l'utilisateur upload une nouvelle photo, on change l'ancienne et on la supprime
			$data['photo'] = $photo;

			$sql = "SELECT photo FROM " . $this->table . " WHERE id = " . $user['id'];

			$sth = $this->dbh->prepare($sql);
			$sth->execute();

			$oldPhoto = $sth->fetch();

			$filepath = 'assets/content/users/' . $oldPhoto['photo'];

	        unlink($filepath);
		}

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
