<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\UserModel;
use W\Security\AuthentificationModel;

class GeneralController extends Controller
{

	/**
	 * Page d'accueil par défaut
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
	        'email' =>  ''
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

			if (empty($error)) {
				$user = new UserModel;

				$user->register($email, $password, $error);

				if (empty($error)) {
					$this->redirectToRoute('home'); // DevNote : faire une redirection vers le dashboard après l'inscription
				}
			}
    	}

		$this->show('general/account', array(
			'error' => (isset($error)) ? $error : '',

			'email' => (!empty($email)) ? $email : ''
		));
	}

     /*
	 * Page mon compte, Traitement de la connexion
	 */
        public function login() {
        $verification = new AuthentificationModel;

            if ($_POST['mode'] == 'login') {

                //debug($_POST['login_email']);
                //debug($_POST['login_password']);

                $email = $_POST['login_email'];
                $password = $_POST['login_password'];

                if ($verification->isValidLoginInfo($email, $password) == 0) {
                    debug($verification->isValidLoginInfo($email, $password));
                    $error['login_email'] = 'Votre identifiant ou mot de passe ne sont pas corrects.';
                    $error['login_password'] = 'Votre identifiant ou mot de passe ne sont pas corrects.';
                } else {
                    $data = $user->find($id);
                    debug($data);
                    $email = $_POST['login_email'];

                    $user->logUserIn($data);

                    $this->redirectToRoute('home'); // DevNote : faire une redirection vers le dashboard après l'inscription

                    // $user->logUserOut();
                }
            }

            $this->show('general/account', array(
                    'error'    => (isset($error)) ? $error : '',
                    'mode'     => (!empty($_POST['mode'])) ? $_POST['mode'] : '',

                    'email'    => (!empty($_POST['email'])) ? $_POST['email'] : ''
            ));

    }

}
