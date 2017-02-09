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
	 * Page d'accueil du dashboard
	 *
	 * @return void
	 */
	public function dashboard()
	{
		$this->allowTo(array('0','1'), 'home');
		$this->show('dashboard/dashboard');
	}

	public function find_product()
	{
		$this->show('dashboard/find_product');
	}

	public function find_winemaker()
	{
		$this->show('dashboard/find_winemaker');
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
	public function newWineMaker()
	{
		if (!empty($_POST)) {
			$error = array();
			$form  = new Form();

			$token   = $_SESSION['user']['id'];
			$siren   = $_POST['siren'];
			$area    = $_POST['area'];
			$address = $_POST['address'];
			$cp      = $_POST['cp'];
			$city    = $_POST['city'];

			//-- Start : Géolocalisation de la latitude et la longitude à partir du code postal //--
			$url = 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyD-S88NjyaazTh3Dmyfht4fsAKRli5v5gI&components=country:France&address=' . $cp;
			$result_string = file_get_contents($url);
			$result = json_decode($result_string, true);
			$result1[] = $result['results'][0];
			$result2[] = $result1[0]['geometry'];
			$result3[] = $result2[0]['location'];

			$lng = $result3[0]['lng'];
			$lat = $result3[0]['lat'];
			//-- End : Géolocalisation de la latitude et la longitude à partir du code postal //--

			$error['siren']   = $form->isValid($siren, 9, 9);
			$error['area']    = $form->isValid($area);
			$error['address'] = $form->isValid($address);
			$error['cp']      = $form->isValid($cp, 5, 5);
			$error['city']    = $form->isValid($city);

			// On filtre le tableau pour retirer les erreurs "vides"
			$error = array_filter($error);

			$winemaker = new WinemakerModel;

			$winemaker->registerWinemaker($token, $siren, $area, $address, $cp, $city, $lng, $lat, $error);

			if (empty($error)) {
				$this->redirectToRoute('dashboard');

				$msg = 'Votre profil de producteur a bien été enregistré.';

				setcookie("successMsg", $msg, time() + 10);
			}
		}

		$this->show('dashboard/newWineMaker', array(
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
		$this->allowToWinemakers('dashboard');

		if(!empty($_POST)) {
			$error = array();
			$form  = new Form();

			// Données du formulaire
 			$name      = $_POST['name'];
			$color     = $_POST['color'];
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

				$product = new ProductModel();
				$product->addProduct($token, $name, $color, $price, $millesime, $cepage, $stock, $bio);

				$msg  = 'Votre ' . $name . ' a bien été ajouté à votre cave.';

				setcookie("successMsg", $msg, time() + 10);

				$this->redirectToRoute('cave');
			}
		}

		$products = new ProductModel();
		$products = $products->findAll();

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
		$this->allowToWinemakers('dashboard');

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
				$product = new ProductModel();
				$product->editProduct($id, $price, $stock);

				$msg  = 'Vos modifications sur le produit ' . $name . ' ont bien été prises en compte.';

				setcookie("successMsg", $msg, time() + 10);

				$this->redirectToRoute('cave');
			}
		}

		$products = new ProductModel();
		$product  = new ProductModel();

		$products = $products->findAll();
		$product  = $product->find($id);

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
	 * Page Ajouter un membre
	 * Réservée à l'administration
	 *
	 * @return void
	 */
	public function addMember()
	{
		$this->allowTo('1', 'dashboard');

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

		$this->show('dashboard/members', array(
				'error' => (isset($error)) ? $error : '',
				'successMsg' =>  $successMsg,
				'email'     => (!empty($email)) ? $email : '',
				'firstname' => (!empty($firstname)) ? $firstname : '',
				'lastname'  => (!empty($lastname)) ? $lastname : '',
		));
	}

	/**
	 * Page Gérer les membres
	 * Réservée à l'administration
	 *
	 * @return void
	 */
	public function members()
	{
		$this->allowTo('1', 'dashboard');

		$members = new UserModel();
		$members = $members->findAll();

		$this->show ('dashboard/members', array(
			'members' => $members
		));
	}

	/**
	 * Traitement "Gérer les membres"
	 * Réservé à l'administration
	 *
	 * @return void
	 */
	public function members_edit()
	{
		$this->allowTo('1', 'dashboard');

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
		$this->allowTo('1', 'dashboard');

		$winemakers = new WinemakerModel();
		// $winemakers = $winemakers->findAll();
	
		$winemakers = $winemakers->getWinemakerbyUser();

		$this->show ('dashboard/winemakers', array(
			'winemakers' => $winemakers,
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
	public function inbox_thread($token)
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
	public function inbox_posting($token)
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
	 * Autorise l'accès aux producteurs uniquement
	 * @param string $redirectRoute Une route où rediriger l'utilisateur. Si vide, montrer la page Forbidden.
	 */
	public function allowToWinemakers($redirectRoute = '')
	{
		$winemaker = new WinemakerModel();

		$token = $_SESSION['user']['id'];

		if ($winemaker->isAWineMaker($token)) {
			return true;
		}

		if (!empty($redirectRoute)) {
			$this->redirectToRoute($redirectRoute);
		}

		$this->showForbidden();
	}

	public function profile_view() {
		$user     = new UserModel();

		$user = $user->getUserByToken($_SESSION['user']['id']);
		$user_id = $user['id']; // Correspond à mon ID d'utilisateur

		/* Récupérer juste l'année et le mois de la date d'enregistrement depuis la BDD et transformer en français */
		$monthEng = array('January', 'February');
		$monthFr = array('Janvier', 'Février');

		$date = strtotime($_SESSION['user']['register_date']);
		$newformat = date('Y F', $date);
		$newDate = str_replace($monthEng, $monthFr, date('F')).' '.date('Y');


		$this->show('dashboard/profile_view', array(
				'user' => $user,
				'date' => $newDate

		));
	}
	
	public function winemakerByUser() {
		$winemakers = new WinemkaerModel();
		$winemaker = $winemakers->getWinemakerbyUser();

		$this->show('dashboard/winemakers', array(
				'winemaker' => $winemaker,

		
		));
	}


}
