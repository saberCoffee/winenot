<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\UserModel;
use W\Security\AuthentificationModel;
use Model\WinemakerModel;

class DashboardController extends Controller
{

	/**
	 * Page d'accueil du dashboard
	 */
	public function dashboard()
	{
		$this->show('dashboard/dashboard');
	}

	/**
	 * Page de création de newWineMaker
	 */
	public function newWineMaker()
	{
		$this->show('dashboard/newWineMaker');
	}

	/**
	 * Page gérer/afficher sa cave
	 */
	public function cave()
	{
		$this->show('dashboard/cave');
	}
	
	/**
	 * Page gérer/afficher les membres
	 *
	 */
	public function members() 
	{


		$members = new UserModel();
		$members = $members->findAll();

		if(isset($_GET['id'])){
			$member = new UserModel();
			$member = $member->find($_GET['id']);
	
		}

		$this->show ('dashboard/members', ['members' => $members]);
	}
	
	public function members_edit() {
	
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
	
	public function winemakers()
	{
		$winemakers = new WinemakerModel();
		$winemakers = $winemakers->findAll();
		
		if(isset($_GET['id'])){
			$winemaker = new UserModel();
			$winemaker = $winemaker->find($_GET['winemakers_id']);
		
		}
		
		$this->show ('dashboard/winemakers', ['winemakers' => $winemakers]);
	}
}
