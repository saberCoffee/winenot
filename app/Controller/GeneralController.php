<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\UserModel;
use \Model\Private_messagesModel;

use W\Security\AuthentificationModel;

class GeneralController extends Controller
{

	/**
	 * Page d'accueil
	 */
	public function home()
	{
		$this->show('general/home');
	}

	/**
	 * Page mon compte
	 */
	public function account() {
		$this->show('general/account', array(
			'error' => '',
			'email' =>  '',
			'firstname' => '',
			'lastname'  => ''
		));
	}

	/**
	 * Page mon compte, Traitement de l'inscription
	 */
	public function register()
	{
		if (!empty($_POST)) {
			$error = array();

			$email          = htmlentities($_POST['register_email']);
			$password       = htmlentities($_POST['register_password']);
			$password_verif = htmlentities($_POST['register_password_verif']);
			$firstname      = htmlentities($_POST['firstname']);
			$lastname       = htmlentities($_POST['lastname']);

			if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
				$error['register_email'] = 'Cette adresse email est invalide.';
			}

			if (empty($password)) {
				$error['register_password'] = 'Vous devez remplir ce champ.';
			} elseif (strlen($password) < 6) {
				$error['register_password'] = 'Vous devez utiliser au moins <strong>6</strong> caractères.';
			} elseif (strlen($password) > 16) {
				$error['register_password'] = 'Vous ne pouvez pas utiliser plus de <strong>16</strong> caractères.';
			} elseif ($password != $password_verif) {
				$error['register_password'] = 'Les mots de passe ne sont pas identiques.';
			}

			if (empty($firstname)) {
				$error['firstname'] = 'Vous devez remplir ce champ.';
			} elseif (strlen($firstname) < 2) {
				$error['firstname'] = 'Vous devez utiliser au moins <strong>2</strong> caractères.';
			} elseif (strlen($firstname) > 16) {
				$error['firstname'] = 'Vous ne pouvez pas utiliser plus de <strong>16</strong> caractères.';
			}

			if (empty($lastname)) {
				$error['lastname'] = 'Vous devez remplir ce champ.';
			} elseif (strlen($lastname) < 2) {
				$error['lastname'] = 'Vous devez utiliser au moins <strong>2</strong> caractères.';
			} elseif (strlen($lastname) > 16) {
				$error['lastname'] = 'Vous ne pouvez pas utiliser plus de <strong>16</strong> caractères.';
			}

			$user = new UserModel;

			$user->register($email, $password, $firstname, $lastname, $error);

			if (empty($error)) {
				$this->redirectToRoute('dashboard');
			}
		}

		$this->show('general/account', array(
			'error' => (isset($error)) ? $error : '',

			'email'     => (!empty($email)) ? $email : '',
			'firstname' => (!empty($firstname)) ? $firstname : '',
			'lastname'  => (!empty($lastname)) ? $lastname : '',
		));
	}

	/*
	 * Page mon compte, Traitement de la connexion
	 */
	public function login() {
		if (!empty($_POST)) {

			$email = $_POST['login_email'];
			$password = $_POST['login_password'];

			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$error['login_email'] = "L'email n'est pas correct.";
			} elseif (strlen($password)<6) {
				$error['login_password'] = "Votre mot de passe est trop court.";
			} elseif (strlen($password)>16) {
				$error['login_password'] = "Votre mot de passe est trop long.";
			}
		}

		if(empty($error)){
			$user = new UserModel;
			$user->login($email, $password, $error);

			if (empty($error)) {
				$this->redirectToRoute('dashboard');
			}
		}

		$this->show('general/account', array(
			'error'    => (isset($error)) ? $error : '',

			'email'    => (!empty($_POST['email'])) ? $_POST['email'] : '',
			'firstname' => '',
			'lastname'  => ''
		));
	}

	/**
	 * Traitement de la déconnexion
	 */
	public function logout() {
		$user = new UserModel;
		$user->logout();

		$this->redirectToRoute('home');
	}

	/**
	 * Page de contact
	 * Cette page sert à envoyer des messages privés à l'administration.
	 * Si on est connecté en tant qu'utilisateur, c'est notre id qui servira de "author_id" dans la table Private_messagesModel.
	 * Sinon, on mettra l'id 0, qui correspond à un invité.
	 */
	public function contact() {
		if (!empty($_POST)) {
			$objet   = $_POST['contact_objet'];
			$email   = $_POST['contact_email'];
			$message = $_POST['contact_msg'];

			$contact = new Private_messagesModel();
			$error = $contact->contact($objet, $email, $message);

			if (!is_numeric($error)) {
				$error = "Votre message n'a pas été envoyé";
			}
		}

		$this->show('general/contact', array(
			'objet'		=>	(!empty($_POST['contact_objet'])) ? $_POST['contact_objet'] : '',
			'email' 	=>  (!empty($_POST['contact_email'])) ? $_POST['contact_email'] : '',
			'message'	=>	(!empty($_POST['contact_msg'])) ? $_POST['contact_msg'] : '',
			'error' 	=> 	(isset($error) && !empty($error)) ? $error : ''
		));
	}

	/**
	 * Page du magazine
	 */
	public function mag()
	{
		$this->show('general/mag');
	}

}
