<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\UserModel;
use W\Security\AuthentificationModel;

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
	public function members() {
		$this->show ('dashboard/members');
	}
}
