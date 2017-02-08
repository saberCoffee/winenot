<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Security\AuthentificationModel;
use \Model\UserModel;
use \Model\WinemakerModel;
use \Model\PrivateMessageModel;
use \Model\ProductModel;


class DashboardController extends Controller
{

	/**
	 * Page d'accueil du dashboard
	 *
	 * @return void
	 */
	public function dashboard()
	{
		$this->show('dashboard/dashboard');
	}

	/**
	 * Page de création de producteurs
	 * Ici, un utilisateur peut créer son profil de producteur
	 *
	 * @return void
	 */
	public function newWineMaker()
	{
		if (isset($_POST)) {
			/*
			$area  = $_POST['area'];
			$address = $_POST['address'];
			$city = $_POST['city'];
			$cp = $_POST['cp'];
			*/
		}

		$this->show('dashboard/newWineMaker');
	}

	/**
	 * Page gérer/afficher sa cave
	 *
	 * @return void
	 */
	public function cave()
	{
		if(!empty($_POST)){
			$error = array();

			$id 			= $_POST['winemaker_id'];
 			$name   	    = $_POST['name'];
			$color  		= $_POST['color'];
			$price 			= $_POST['price'];
			$price 			= str_replace(',','.', $price);
			$millesime 		= $_POST['millesime'];
			$cepage 		= $_POST['cepage'];
			$stock 			= $_POST['stock'];
			$bio = (empty($_POST['bio'])) ? 0 : 1;

			if (empty($name)) {
				$error['name'] = 'Vous devez remplir ce champ.';
			} elseif (strlen($name) < 3) {
				$error['name'] = 'Vous devez utiliser au moins <strong>3</strong> caractères.';
			} elseif (strlen($name) > 16) {
				$error['name'] = 'Vous ne pouvez pas utiliser plus de <strong>16</strong> caractères.';
			}


			if (empty($color)) {
				$error['color'] = 'Vous devez selectionner une couleur.';
			}


			if (empty($price)) {
				$error['price'] = 'Vous devez remplir ce champ.';
			} elseif (!is_numeric($price)) {
				$error['price'] = 'Vous devez saisir des chiffres.';
			}



			if (empty($millesime)) {
				$error['millesime'] = 'Vous devez remplir ce champ.';
			} elseif (!is_numeric($millesime)) {
				$error['millesime'] = 'Vous devez saisir des chiffres.';
			} elseif (strlen($millesime) < 4 || strlen($millesime) > 4) {
				$error['millesime'] = 'Vous devez utiliser <strong>4</strong> chiffres.';
			}


			if (empty($cepage)) {
				$error['cepage'] = 'Vous devez remplir ce champ.';
			} elseif (strlen($cepage) < 3) {
				$error['cepage'] = 'Vous devez utiliser au moins <strong>3</strong> caractères.';
			} elseif (strlen($cepage) > 16) {
				$error['cepage'] = 'Vous ne pouvez pas utiliser plus de <strong>16</strong> caractères.';
			}

			if (empty($stock)) {
				$error['stock'] = 'Vous devez remplir ce champ.';
			} elseif (!is_numeric($stock)) {
				$error['stock'] = 'Vous devez saisir des chiffres.';
			} elseif (strlen($stock) < 2 ) {
				$error['stock'] = 'Vous devez utiliser au moins <strong>2</strong> chiffres.';
			}



			$product = new ProductModel();
			$product->product($id, $name, $color, $price, $millesime, $cepage, $stock, $bio, $error);
			//debug($name['color']);
		}

		$this->show('dashboard/cave', array(
			'winemakers_id'	=>	(!empty($_POST['winemakers_id'])) ? $_POST['winemakers_id'] : '',
			'name'		    =>	(!empty($_POST['name'])) ? $_POST['name'] : '',
			'color' 		=>  (!empty($_POST['color'])) ? $_POST['color'] : '',
			'price'			=>	(!empty($_POST['price'])) ? $_POST['price'] : '',
			'millesime'		=>	(!empty($_POST['millesime'])) ? $_POST['millesime'] : '',
			'cepage'		=>	(!empty($_POST['cepage'])) ? $_POST['cepage'] : '',
			'stock'			=>	(!empty($_POST['stock'])) ? $_POST['stock'] : '',
			'bio'			=>	(!empty($_POST['bio'])) ? $_POST['bio'] : '',
			'error' 		=> 	(isset($error) && !empty($error)) ? $error : ''


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
		/*
			DevNote : Penser à ajouter une vérification que l'utilisateur est bien connecté en tant qu'admin. Si ce n'est pas le cas, le rediriger.
		*/
		$members = new UserModel();
		$members = $members->findAll();

		if(isset($_GET['id'])){
			$member = new UserModel();
			$member = $member->find($_GET['id']);
		}

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
	public function members_edit() {
		/*
			DevNote : Penser à ajouter une vérification que l'utilisateur est bien connecté en tant qu'admin. Si ce n'est pas le cas, le rediriger.
		*/
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
		/*
			DevNote : Penser à ajouter une vérification que l'utilisateur est bien connecté en tant qu'admin. Si ce n'est pas le cas, le rediriger.
		*/
		$winemakers = new WinemakerModel();
		$winemakers = $winemakers->findAll();

		if(isset($_GET['id'])){
			$winemaker = new UserModel();
			$winemaker = $winemaker->find($_GET['winemakers_id']);
		}

		$this->show ('dashboard/winemakers', array(
			'winemakers' => $winemakers
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

}
