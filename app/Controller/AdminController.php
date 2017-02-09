<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Security\AuthentificationModel;
use \W\Model\Model;
use \W\WineNotClasses\Form;

use \Model\UserModel;
use \Model\ProductModel;
use \Model\WinemakerModel;
use \Model\PrivateMessageModel;

class AdminController extends Controller
{

    /**
     * Page Gérer les membres
     * Réservée à l'administration
     *
     * @return void
     */
    public function members()
    {
        $this->allowTo('admin', 'dashboard');

        $members = new UserModel();
        $members = $members->findAll();

        $this->show ('admin/members', array(
            'members' => $members
        ));
    }

	/**
	 * Page Ajouter un membre
	 * Réservée à l'administration
	 *
	 * @return void
	 */
	public function addMember()
	{
		$this->allowTo('admin', 'dashboard');

		if (!empty($_POST)) {
			$error = array();
			$form  = new Form();

			$email          = htmlentities($_POST['email']);
			$password       = htmlentities($_POST['password']);
			$password_verif = htmlentities($_POST['password_verif']);
			$firstname      = htmlentities($_POST['firstname']);
			$lastname       = htmlentities($_POST['lastname']);
			$address        = htmlentities($_POST['address']);
			$city       	= htmlentities($_POST['city']);
			$postcode       = htmlentities($_POST['postcode']);
			$role       	= htmlentities($_POST['role']);
			$type       	= htmlentities($_POST['type']);

			if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
				$error['email'] = 'Cette adresse email est invalide.';
			}

			$error['firstname'] = $form->isValid($firstname, 2, 16);
			$error['lastname']  = $form->isValid($lastname, 2, 16);

			$user = new UserModel;

			$user->registerFromAdmin($email, $password, $firstname, $lastname, $address, $city, $postcode, $role, $type, $error);

			if (empty($error)) {
				$_SESSION['msg'] = "L'utilisateur a bien été enregistré.";
				$this->redirectToRoute('members');
			}
		}

		$this->show('admin/members', array(
				'error' => (isset($error)) ? $error : '',
				'successMsg' =>  $successMsg,
				'email'     => (!empty($email)) ? $email : '',
				'firstname' => (!empty($firstname)) ? $firstname : '',
				'lastname'  => (!empty($lastname)) ? $lastname : '',
		));
	}

	/**
	 * Traitement "Gérer les membres"
	 * Réservé à l'administration
	 *
	 * @return void
	 */
	public function editMember()
	{
		$this->allowTo('admin', 'dashboard');

		if(isset($_POST)){
			$member = new UserModel();
			$id = $member->find($_GET['id']);
			$member = $member->find('2620528902ee37259c51a57d2367dd67');
			debug($member);

			$data = array(
					'firstname' => strip_tags($_POST['firstname']),
			);

			$member->update($data, $id);
		}
	}

	/**
	 * Page Gérer les producteurs
	 * Réservée à l'administration
	 *
	 * @return void
	 */
	public function winemakers()
	{
		$this->allowTo('admin', 'dashboard');

		$winemakers = new WinemakerModel();
		// $winemakers = $winemakers->findAll();

		$winemakers = $winemakers->getWinemakerbyUser($_SESSION['user']['id']);

		$this->show ('admin/winemakers', array(
			'winemakers' => $winemakers,
		));
	}

}
