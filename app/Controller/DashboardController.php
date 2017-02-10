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

class DashboardController extends Controller
{

	/**
	 * Constructeur
	 */
	public function __construct()
	{
		$this->allowTo(array('user','admin'));
	}

	/**
	 * Page d'accueil du dashboard
	 *
	 * @return void
	 */
	public function home()
	{
		$this->show('dashboard/home');
	}

	public function products()
	{
		$user       = new UserModel();
		$winemakers = new WinemakerModel();
		$products   = new ProductModel();

		$products = $products->findAll('*', 'couleur');

		$i = 0;
		foreach ($products as $product) {
			$token = $user->getTokenByUserId($product['winemaker_id']);

			$products[$i]['winemaker'] = $winemakers->getWinemakerFullDetails($token);
			++$i;
		}

		$this->show('dashboard/products', array(
			'products' => $products
		));
	}

	public function winemakers()
	{
		$this->show('dashboard/winemakers');
	}

	public function wishlist()
	{
		$this->show('dashboard/wishlist');
	}

	/**
	 * Page de création de producteurs
	 * Ici, un utilisateur peut créer son profil de producteur
	 *
	 * @return void
	 */
	public function registerWinemaker()
	{
		$this->allowToWinemakers('dashboard_home', true);

		if (!empty($_POST)) {
			$error = array();
			$form  = new Form();

			$token    = $_SESSION['user']['id'];
			$siren    = $_POST['siren'];
			$area     = $_POST['area'];
			$address  = $_POST['address'];
			$postcode = $_POST['postcode'];
			$city     = $_POST['city'];

			//-- Start : Géolocalisation de la latitude et la longitude à partir du code postal //--
			$url = 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyD-S88NjyaazTh3Dmyfht4fsAKRli5v5gI&components=country:France&address=' . $postcode;
			$result_string = file_get_contents($url);
			$result = json_decode($result_string, true);
			$result1[] = $result['results'][0];
			$result2[] = $result1[0]['geometry'];
			$result3[] = $result2[0]['location'];

			$lng = $result3[0]['lng'];
			$lat = $result3[0]['lat'];
			//-- End : Géolocalisation de la latitude et la longitude à partir du code postal //--

			$error['siren']    = $form->isValid($siren, 9, 9);
			$error['area']     = $form->isValid($area);
			$error['address']  = $form->isValid($address);
			$error['postcode'] = $form->isValid($postcode, 5, 5);
			$error['city']     = $form->isValid($city);

			// On filtre le tableau pour retirer les erreurs "vides"
			$error = array_filter($error);

			$winemaker = new WinemakerModel;

			$winemaker->registerWinemaker($token, $siren, $area, $address, $postcode, $city, $lng, $lat, $error);

			if (empty($error)) {
				$this->redirectToRoute('dashboard_home');

				$msg = 'Votre profil de producteur a bien été enregistré.';

				setcookie("successMsg", $msg, time() + 5);
			}
		}

		$this->show('dashboard/register_winemaker', array(
			'error' => (isset($error)) ? $error : '',
		));
	}

	/**
	 * Page gérer/afficher sa cave (Mode Ajout)
	 * Deux onglets : un premier pour ajouter un produit, un second pour afficher tous les produits du producteur (avec des liens pour les éditer)
	 *
	 * @return void
	 */
	public function cave()
	{
		$this->allowToWinemakers('dashboard_home');

		$user      = new UserModel();
		$winemaker = new WinemakerModel();
		$products  = new ProductModel();

		$user      = $user->getUserByToken($_SESSION['user']['id']);
		$winemaker = $winemaker->find($user['id']);


		if(!empty($_POST)) {
			$error = array();
			$form  = new Form();

			// Données du formulaire
 			$name      = $_POST['name'];
			$color     = $_POST['color'];
			$region    = $winemaker['region'];
			$price 	   = str_replace(',','.', $_POST['price']);
			$millesime = $_POST['millesime'];
			$cepage    = $_POST['cepage'];
			$stock 	   = $_POST['stock'];
			$bio       = (empty($_POST['bio'])) ? 0 : 1;

			// Vérification des données du formulaire
			$error['name']      = $form->isValid($name, 3, 50);
			$error['color']     = $form->isValid($color);
			$error['price']     = $form->isValid($price, '', '', true);
			$error['millesime'] = $form->isValid($millesime, 4, 4, true);
			$error['cepage']    = $form->isValid($cepage, 3, 50);
			$error['stock']     = $form->isValid($stock, '', '', true);

			// On filtre le tableau pour retirer les erreurs "vides"
			$error = array_filter($error);

			if (empty($error)) {
				$token = $_SESSION['user']['id'];
				$products->addProduct($token, $name, $color, $region, $price, $millesime, $cepage, $stock, $bio);

				$msg  = 'Votre ' . $name . ' a bien été ajouté à votre cave.';

				setcookie("successMsg", $msg, time() + 5);

				$this->redirectToRoute('cave');
			}
		}

		$products = $products->findProductsFrom($user['id']);

		$this->show('dashboard/cave', array(
			// Liste des produits de la cave
			'products' 	=> $products,

			// Données du formulaire
			'name'		=> (!empty($_POST['name'])) ? $_POST['name'] : '',
			'color' 	=> (!empty($_POST['color'])) ? $_POST['color'] : '',
			'price'		=> (!empty($_POST['price'])) ? $_POST['price'] : '',
			'millesime' => (!empty($_POST['millesime'])) ? $_POST['millesime'] : '',
			'cepage'    => (!empty($_POST['cepage'])) ? $_POST['cepage'] : '',
			'stock'	    => (!empty($_POST['stock'])) ? $_POST['stock'] : '',
			'bio'	    => (!empty($_POST['bio'])) ? $_POST['bio'] : '',

			// Erreurs du formulaire
			'error'     => (!empty($error)) ? $error : '',
		));
	}

	/**
	 * Page gérer/afficher sa cave (Mode Édition)
	 * Deux onglets : un premier pour éditer un produit, un second pour afficher tous les produits du producteur
	 *
	 * @param int $id L'id du produit
	 *
	 * @return void
	 */
	public function cave_edit($id)
	{
		$this->allowToWinemakers('dashboard_home');

		$products = new ProductModel();

		if(!empty($_POST)) {
			$error = array();
			$form  = new Form();

			// Données du formulaire
			$price = str_replace(',','.', $_POST['price']);
			$stock = (string) $_POST['stock'];

			// Vérification des données du formulaire
			$error['price'] = $form->isValid($price, '', '', true);
			$error['stock'] = $form->isValid($stock, '', '', true);

			// On filtre le tableau pour retirer les erreurs "vides"
			$error = array_filter($error);

			if (empty($error)) {
				$products->editProduct($id, $price, $stock);

				$msg  = 'Vos modifications sur le produit ' . $name . ' ont bien été prises en compte.';

				setcookie("successMsg", $msg, time() + 5);

				$this->redirectToRoute('cave');
			}
		}

		$products = $products->findProductsFrom($user['id']);
		$product  = $products->find($id);

		$this->show('dashboard/cave_edit', array(
			// Liste des produits de la cave
			'products' => $products,
			// Fiche du produit en cours d'édition
			'product'  => $product,

			// Données du formulaire
			'price'	   => (!empty($_POST['price'])) ? $_POST['price'] : $product['price'],
			'stock'	   => (!empty($_POST['stock'])) ? $_POST['stock'] : $product['stock'],

			// Erreurs du formulaire
			'error'    => (!empty($error)) ? $error : '',
		));
	}

	/**
	 * Page d'accueil de la messagerie du dashboard
	 *
	 * @return void
	 */
	public function inbox()
	{
		$user     = new UserModel();
		$messages = new PrivateMessageModel();

		$user     = $user->getUserByToken($_SESSION['user']['id']);
		$messages = $messages->getActiveThreads($user['id']);

		$count_unread_messages = 0;
		foreach ($messages as $message) {
			if (!$message['isRead']) $count_unread_messages++;
		}

		$this->show ('dashboard/inbox', array(
			'messages'              => $messages,
			'count_unread_messages' => $count_unread_messages
		));
	}

	/**
	 * Fils de discussion des utilisateurs
	 *
	 * @param  [type] $token [description]
	 * @return [type]        [description]
	 */
	public function inboxThread($token)
	{
		$user     = new UserModel();
		$messages = new PrivateMessageModel();

		$user1 = $user->getUserByToken($_SESSION['user']['id']);
		$user1 = $user1['id']; // Correspond à mon ID d'utilisateur

		$user2 = $user->getUserByToken($token);
		$user2 = $user2['id']; // Correspond à l'ID de l'utilisateur avec qui j'ai un fil de discussion

		$messages = $messages->getMessagesFromThread($user1, $user2);

		/*
			Ce bout de code sert à attribuer une classe row à chaque auteur
		*/
		$i       = 0;
		$classes = array();
		// Afin de garder le même ordre pour les classes CSS, il faut inverser l'ordre de l'array car le premier utilisateur rencontré récupère la classe row1. Or, si un nouveau message est posté, l'ordre serait potentiellement inversé car le premier posteur serait peut-être différent du précédent.
		$messages = array_reverse($messages);
		foreach ($messages as $message) {
			if ($i == 0) {
				$subject = $message['subject'];
			}

			if (empty($classes[$message['firstname']])) {
				if (empty($classes)) {
					$classes[$message['firstname']] = 'row1';
				} else {
					$classes[$message['firstname']] = 'row2';
				}
			}

			$messages[$i]['classe'] = $classes[$message['firstname']];

			$i++;
		}
		$messages = array_reverse($messages);

		$this->show ('dashboard/thread', array(
			'messages' => $messages,
			'subject'  => $subject,
			'token'    => $token
		));
	}

	/**
	 * [inbox_posting description]
	 * @param  [type] $token [description]
	 * @return [type]        [description]
	 */
	public function inboxPosting($token)
	{
		$user    = new UserModel();
		$message = new PrivateMessageModel();

		$receiver_id = $user->getUserByToken($token);
		$receiver_id = $receiver_id['id'];

		$author_id = $user->getUserByToken($_SESSION['user']['id']);
		$author_id = $author_id['id']; // Correspond à mon ID d'utilisateur

		$message->sendMessage($receiver_id, $author_id, $_POST['subject'], $_POST['content']);

		$this->redirectToRoute('inbox_thread', ['id' => $token]);
	}

	/**
	 * Autorise l'accès aux producteurs (par défaut) ou, inversement, aux NON-producteurs
	 *
	 * @param [string]  $redirectRoute Une route où rediriger l'utilisateur. Si vide, montrer la page Forbidden.
	 * @param [boolean] $noWinemaker Si réglé sur false, on autorise l'accès aux producteurs. Sinon, on autorise l'accès aux non-producteurS.
	 *
	 * @return [mixed] Un boolean true si le passage est autorisé | void sinon
	 */
	public function allowToWinemakers($redirectRoute = '', $noWinemaker = false)
	{
		$winemaker = new WinemakerModel();

		$token = $_SESSION['user']['id'];

		if (!$noWinemaker) {
			if ($winemaker->isAWineMaker($token)) {
				return true;
			}
		} else {
			if (!$winemaker->isAWineMaker($token)) {
				return true;
			}
		}

		if (!empty($redirectRoute)) {
			$this->redirectToRoute($redirectRoute);
		}

		$this->showForbidden();
	}

	public function userProfile($token)
	{
		if (!empty($_POST)) {
			$error = array();
			$form  = new Form();

			$firstname      = (!empty($_POST['firstname'])) ? $_POST['firstname'] : '';
			$lastname       = (!empty($_POST['lastname'])) ? $_POST['lastname'] : '';
			$role           = (!empty($_POST['role'])) ? $_POST['role'] : '';

			$email          = $_POST['email'];
			$password       = $_POST['password'];
			$password_verif = $_POST['password_verif'];
			$address        = $_POST['address'];
			$postcode       = $_POST['postcode'];
			$city           = $_POST['city'];

			if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
				$error['email'] = 'Cette adresse email est invalide.';
			}

			// Changer son mot de passe est optionnel ; on vérifie si les bonnes informations ont été rentrées uniquement s'il n'est pas vide
			if (!empty($password)) {
				$error['password'] = $form->isValid($password, 6, 16);

				if ($password != $password_verif) {
					$error['password'] = 'Les mots de passe ne sont pas identiques.';
				}
			}

			$error['address']  = $form->isValid($address);
			$error['postcode'] = $form->isValid($postcode, 5, 5, true);
			$error['city']     = $form->isValid($city);

			// On filtre le tableau pour retirer les erreurs "vides"
			$error = array_filter($error);

			$user = new UserModel;

			$user->updateProfile($token, $email, $password, $firstname, $lastname, $address, $postcode, $city, $role, $error);

			if (empty($error)) {
				$this->redirectToRoute('user_profile', ['id' => $token]);
				echo 'aucune erreur';
			}
		}

		$user = new UserModel();

		$user = $user->getUserByToken($token);
		$user['id'] = $token; // On remplace l'id de l'utilisateur par son token

		/* Récupérer juste l'année et le mois de la date d'enregistrement depuis la BDD et transformer en français */
		$monthsEng = array('January', 'February', 'March', 'April', 'May', 'June', 'July ', 'August', 'September', 'October', 'November', 'December');
		$monthsFr  = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

		$date      = strtotime($_SESSION['user']['register_date']);
		$newformat = date('Y F', $date);
		$newDate   = str_replace($monthsEng, $monthsFr, date('F')).' '.date('Y');

		// Afin de cacher certaines informations, on initialise une variable qui détermine si le profil consulté appartient à l'utilisateur, et une autre si on a l'autorisation de le lire (car on est admin, ou car on est en discussion avec l'utilisateur)
		$is_owner           = ($user['id'] == $_SESSION['user']['id']) ? 1 : 0;
		$is_allowed_to_read = ($user['id'] == $_SESSION['user']['id'] || $_SESSION['user']['role'] == 'admin') ? 1 : 0;
		$is_allowed_to_edit = ($user['id'] == $_SESSION['user']['id'] || $_SESSION['user']['role'] == 'admin') ? 1 : 0;

		// Certains textes vont changer selon le contexte
		$lang = array(
			'profile'      => ($is_owner) ? 'Mon profil' : 'Profil de ' . $user['firstname'] . ' ' . $user['lastname'],
			'profile_edit' => ($is_owner) ? 'Éditer mes informations' : 'Éditer les informations de ' . $user['firstname'] . ' ' . $user['lastname']
		);

		$this->show('dashboard/profile', array(
			// Permissions de l'utilisateur sur la page
			'is_allowed_to_read' => $is_allowed_to_read,
			'is_allowed_to_edit' => $is_allowed_to_edit,
			'is_owner'			 => $is_owner,

			// Données du profil
			'user'               => $user,
			'register_date'      => $newDate,

			// Données du formulaire
			'firstname'          => (!empty($_POST['firstname'])) ? $_POST['firstname'] : $user['firstname'],
			'lastname'           => (!empty($_POST['lastname'])) ? $_POST['lastname'] : $user['lastname'],
			'role'               => (!empty($_POST['role'])) ? $_POST['role'] : $user['role'],
			'email'	             => (!empty($_POST['email'])) ? $_POST['email'] : $user['email'],
			'address'            => (!empty($_POST['address'])) ? $_POST['address'] : $user['address'],
			'postcode'	         => (!empty($_POST['postcode'])) ? $_POST['postcode'] : $user['postcode'],
			'city'	             => (!empty($_POST['city'])) ? $_POST['city'] : $user['city'],

			// Erreurs du formulaire
			'error'              => (!empty($error)) ? $error : '',

			// Textes changeants selon le contexte
			'lang'               => $lang
		));
	}

}
