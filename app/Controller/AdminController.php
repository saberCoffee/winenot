<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Security\AuthentificationModel;
use \W\Model\Model;
use \W\WineNotClasses\Form;

use \Model\UserModel;
use \Model\TokenModel;
use \Model\ProductModel;
use \Model\WinemakerModel;
use \Model\PrivateMessageModel;

class AdminController extends Controller
{

	/**
	 * Constructeur
	 */
	public function __construct()
	{
		$this->allowTo(array('admin'));

		$userModel = new UserModel();

		$user = $userModel->getUserByToken($_SESSION['user']['id']);

		if (empty($user)) { // La session n'existe plus car quelqu'un d'autre s'est connecté. Au revoir, user !
			$userModel->logout();
			$this->redirectToRoute('account');
		}
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

        // On réécrit l'id réel du membre par son token
        $i = 0;
        foreach($members as $member)
        {
            $members[$i]['id'] = $memberModel->getTokenByUserId($member['id']);
            $i++;
        }

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

			$email          = $_POST['email'];
			$password       = $_POST['password'];
			$password_verif = $_POST['password_verif'];
			$firstname      = $_POST['firstname'];
			$lastname       = $_POST['lastname'];
			$address        = $_POST['address'];
			$city       	= $_POST['city'];
			$postcode       = $_POST['postcode'];
			$role       	= $_POST['role'];

			if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
				$error['email'] = 'Cette adresse email est invalide.';
			}

			$error['password'] = $form->isValid($password, 6, 16);
			if ($password != $password_verif) {
				$error['password'] = 'Les mots de passe ne sont pas identiques.';
			}

			$error['firstname'] = $form->isValid($firstname, 2, 25);
			$error['lastname']  = $form->isValid($lastname, 2, 25);

			if (!empty($postcode)){
				$error['postcode']  = $form->isValid($postcode, 5, 5);
			}

			// On filtre le tableau pour retirer les erreurs "vides"
			$error = array_filter($error);

			$userModel = new UserModel;

			if (empty($error)) {
				$token = $userModel->registerFromAdmin($email, $password, $firstname, $lastname, $address, $city, $postcode, $role, $error);

				if (empty($error)) {
					$msg = 'Un nouvel utilisateur nommé ' . $firstname . ' ' . $lastname . ' a bien été enregistré.<br /><a href="../profile/user/' . $token . '">Aller sur son profil</a>';

					setcookie("successMsg", $msg, time() + 5);

					$this->redirectToRoute('admin_members');
				}
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
		$winemakerModel = new WinemakerModel();
		$userModel      = new UserModel();

		$winemakers = $winemakerModel->getWinemakersFullDetails();

		$i = 0;
		foreach ($winemakers as $winemaker) {
			$token = $userModel->getTokenByUserId($winemaker['winemaker_id']);

			$winemakers[$i]['winemaker_id'] = $token;

			++$i;
		}

		$this->show ('admin/winemakers', array(
			'winemakers' => $winemakers,
		));
	}

	public function products()
	{
		$error = '';

		$productModel = new ProductModel();

		$products = $productModel->findAll();

		if (!empty($_POST['submit'])) {
			$i = 0;
			foreach ($products as $product) {
				if (!empty($_POST['wine_of_the_month']) && in_array($product['id'], $_POST['wine_of_the_month'])) {
					$products[$i]['checked'] = 1;
				} else {
					$products[$i]['checked'] = 0;
				}

				++$i;
			}

			if (!empty($_POST['wine_of_the_month'])) {
				$selection    = $_POST['wine_of_the_month'];
				$nbSelections = count($selection);

				if ($nbSelections == 6) {
					$productModel->setWinesOfTheMonth($selection);

					$msg = 'Les vins du mois ont bien été mis à jour.';

					setcookie("successMsg", $msg, time() + 5);

					$this->redirectToRoute('admin_products');
				} else {
					$error = 'Attention, vous devez sélectionner <strong>6</strong> vins et vous avez choisi <strong>' . $nbSelections . '</strong> !';
				}
			} else {
				$error = 'Attention, vous devez sélectionner <strong>6</strong> vins !';
			}
		} else {
			$i = 0;
			foreach ($products as $product) {
				if ($product['wine_of_the_month'] == 1) {
					$products[$i]['checked'] = 1;
				} else {
					$products[$i]['checked'] = 0;
				}

				++$i;
			}
		}

		$this->show ('admin/products', array(
			// La liste de produits du site
			'products'  => $products,

			// Données du formulaire
			'selection' => (!empty($selection)) ? $selection : '',

			// Gestion des erreurs du formulaire
			'error'     => $error
		));
	}

}
