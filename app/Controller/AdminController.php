<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Security\AuthentificationModel;
use \W\Model\Model;
use \W\WineNotClasses\Form;

use \Model\UserModel;
use \Model\ProductModel;
use \Model\TokenModel;
use \Model\WinemakerModel;
use \Model\PrivateMessageModel;

class AdminController extends Controller
{

	/**
	 * Constructeur
	 */
	public function __construct()
	{
		$this->allowTo(array('user','admin'));
	}

    /**
     * Page Gérer les membres
     * Réservée à l'administration
     *
     * @return void
     */
    public function members()
    {
        $memberModel = new UserModel();
        $members = $memberModel->findAll();

        foreach($members as $member)
        {
        	$member['id'] = $memberModel->getTokenByUserId($member['id']);
        }

        debug($members);

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
			if (!empty($postcode)){
				$error['postcode']  = $form->isValid($postcode, 5, 5);
			}


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
	 * Traitement "Modifier les membres"
	 * Réservé à l'administration
	 *
	 * @return void
	 */
	public function editMember($id)
	{
		if(!empty($_POST)) {

			$error = array();
			$form  = new Form();

			// Données du formulaire
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$email = $_POST['email'];
			$address = $_POST['address'];
			$city = $_POST['city'];
			$postcode = $_POST['postcode'];
			$role = $_POST['role'];
			$type = $_POST['type'];

			$data = array(
				'firstname' => $firstname,
				'lastname' => $lastname,
				'email' => $email,
				'address' => $address,
				'city' => $city,
				'postcode' => $postcode,
				'role' => $role,
				'type' => type
			);

			// Vérificationo des données du formualire
			$error['firstname'] = $form->isValide($firstname, '', '', true);
			$error['lastname'] = $form->isValide($lastname, '', '', true);
			$error['email'] = $form->isValide($email, '', '', true);
			$error['address'] = $form->isValide($address, '', '', true);
			$error['city'] = $form->isValide($city, '', '', true);
			$error['postcode'] = $form->isValide($postcode, '', '', true);
			$error['role'] = $form->isValide($role, '', '', true);

			// On filtre le tableau pour retirer les erreurs "vides"
			$error = array_filter($error);

			if (empty($error)) {
				$member = new UserModel();
				$member->update($data, $id);

				$msg = 'Votre modification a été bien enregistré.';

				setcookie("successMsg", $msg, time() + 5);

				$this->redirectToRoute('admin_members');
				}
			}

			$members = new UserModel();
			$member = new UserModel();

			$members = $members->findAll();
			$member =  $member->find($id);

			$this->show('admin/admin_members', array(

				'member' => $member,
				'members' => $members,
				// Erreurs du formulaire
				'error'    => (!empty($error)) ? $error : '',
			));
	}

	/**
	 * Page Gérer les producteurs
	 * Réservée à l'administration
	 *
	 * @return void
	 */
	public function winemakers()
	{
		$winemakers = new WinemakerModel();
		// $winemakers = $winemakers->findAll();

		$winemakers = $winemakers->getWinemakerbyUser($_SESSION['user']['id']);

		$this->show ('admin/winemakers', array(
			'winemakers' => $winemakers,
		));
	}

}
