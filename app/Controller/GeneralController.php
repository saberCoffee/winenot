<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Security\AuthentificationModel;
use \W\WineNotClasses\Form;

use \Model\MagModel;
use \Model\UserModel;
use \Model\WinemakerModel;
use \Model\PrivateMessageModel;

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
		if (!empty($_SESSION['user'])) {
			$this->redirectToRoute('dashboard_home');
		}

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
			$form  = new Form();

			$email          = htmlentities($_POST['register_email']);
			$password       = htmlentities($_POST['register_password']);
			$password_verif = htmlentities($_POST['register_password_verif']);
			$firstname      = ucfirst(htmlentities($_POST['firstname']));
			$lastname       = ucfirst(htmlentities($_POST['lastname']));

			if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
				$error['register_email'] = 'Cette adresse email est invalide.';
			}

			$error['password']    = $form->isValid($password, 6, 16);
			if ($password != $password_verif) {
				$error['register_password'] = 'Les mots de passe ne sont pas identiques.';
			}

			$error['firstname'] = $form->isValid($firstname, 2, 16);
			$error['lastname']  = $form->isValid($lastname, 2, 16);

			if (empty($error)) {
				$userModel = new UserModel;

				$userModel->register($email, $password, $firstname, $lastname, $error);

				if (empty($error)) {
					$this->redirectToRoute('dashboard_home');
				}
			}
		}

		$this->show('general/account', array(
			// Données du formulaire
			'email'     => (!empty($email)) ? $email : '',
			'firstname' => (!empty($firstname)) ? $firstname : '',
			'lastname'  => (!empty($lastname)) ? $lastname : '',

			// Erreurs du formulaire
			'error' => (isset($error)) ? $error : ''
		));
	}

	/*
	 * Page mon compte, Traitement de la connexion
	 */
	public function login() {
		if (!empty($_POST)) {
			$email    = $_POST['login_email'];
			$password = $_POST['login_password'];

			if(empty($error)){
				$userModel = new UserModel;

				$userModel->login($email, $password, $error);

				if (empty($error)) {
					$this->redirectToRoute('dashboard_home');
				}
			}
		}

		$this->show('general/account', array(
			// Données du formulaire
			'email'     => (!empty($_POST['email'])) ? $_POST['email'] : '',
			'firstname' => (!empty($firstname)) ? $firstname : '',
			'lastname'  => (!empty($lastname)) ? $lastname : '',

			// Erreurs du formulaire
			'error' => (isset($error)) ? $error : ''
		));
	}

	/**
	 * Page mon compte, Traitement de la déconnexion
	 */
	public function logout() {
		$UserModel = new UserModel;

		$UserModel->logout();

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
			$message = nl2br($_POST['contact_msg']);

			$contact = new PrivateMessageModel();
			$error = $contact->contact($objet, $email, $message);

			if (!is_numeric($error)) {
				$error = "Votre message n'a pas été envoyé";
			}
		}

		$this->show('general/contact', array(
			// Données du formulaire
			'objet'	  => (!empty($_POST['contact_objet'])) ? $_POST['contact_objet'] : '',
			'email'   => (!empty($_POST['contact_email'])) ? $_POST['contact_email'] : '',
			'message' => (!empty($_POST['contact_msg'])) ? $_POST['contact_msg'] : '',

			// Erreurs du formulaire
			'error'   => (isset($error) && !empty($error)) ? $error : ''
		));
	}

	/**
	 * Page d'accueil du magazine
	 */
	public function mag()
	{
		$this->show('general/mag');
	}

	/**
	 * Page d'un article du magazine
	 */
	public function article()
	{
		$this->show('general/article');
	}

	/**
	 * Page ajouter un article au magazine
	 */
	public function add_article()
	{
		$this->allowTo(array('admin'), 'home');

		$magModel = new MagModel;

		$articles = $magModel->allArticles();

		$this->show('general/add_article', array(
			'articles' => $article
		));
	}


	/**
	 * Méthode pour ajax google map latitude et longitude
	 */
	public function latlng()
	{
		$winemakerModel = new WinemakerModel();

		$latlng = $winemakerModel->latlng();

		echo json_encode($latlng);
	}

}
