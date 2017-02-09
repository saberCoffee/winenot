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
            'members' 	=> $members,
			'email'     => '',
			'firstname' => '',
			'lastname'  => '',
			'address'   => '',
			'city'     	=> '',
			'postcode'  => '',
			'role'     	=> '',
			'type'     	=> '',


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
	
		$members = new UserModel();
		$members = $members->findAll();
		
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
			

			if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
				$error['email'] = 'Cette adresse email est invalide.';
			}

			if (empty($password)) {
				$error['password'] = 'Vous devez remplir ce champ.';
			} elseif (strlen($password) < 6) {
				$error['password'] = 'Vous devez utiliser au moins <strong>6</strong> caractères.';
			} elseif (strlen($password) > 16) {
				$error['password'] = 'Vous ne pouvez pas utiliser plus de <strong>16</strong> caractères.';
			} elseif ($password != $password_verif) {
				$error['password'] = 'Les mots de passe ne sont pas identiques.';
			}

			$error['firstname'] = $form->isValid($firstname, 2, 16);
			$error['lastname']  = $form->isValid($lastname, 2, 16);
			$error['postcode']  = $form->isValid($postcode, 5, 5);


			// On filtre le tableau pour retirer les erreurs "vides"
			$error = array_filter($error);

			$user = new UserModel;

			$user->registerFromAdmin($email, $password, $firstname, $lastname, $address, $city, $postcode, $role, $error);

			if (empty($error)) {
				$msg = 'Votre profil de producteur a bien été enregistré.';
			
				setcookie("successMsg", $msg, time() + 5);
				
				$this->redirectToRoute('admin_members');
			}
		}

		$this->show('admin/members', array(
				'error' 	=> (isset($error)) ? $error : '',
            	'members' 	=> $members,
				'email'     => (!empty($email)) ? $email : '',
				'firstname' => (!empty($firstname)) ? $firstname : '',
				'lastname'  => (!empty($lastname)) ? $lastname : '',
				'address'  	=> (!empty($address)) ? $address : '',
				'city'  	=> (!empty($city)) ? $city : '',
				'postcode'  => (!empty($postcode)) ? $postcode : '',
				'role' 		=> (!empty($role)) ? $role : '',
			
				

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
