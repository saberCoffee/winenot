<?php
namespace Model;

use \W\Model\Model;
use \W\Model\ConnectionModel;
use \W\Security\AuthentificationModel;

use \Model\UserModel;
use \Model\TokenModel;

class WinemakerModel extends Model
{

	protected $primaryKey = 'winemaker_id';

	/**
 	 * Créé un nouveau profil de producteur associé à un utilisateur
 	 *
	 * @param  string  $token        Le token de l'utilisateur, dont on se sert pour déterminer son id
	 * @param  int     $siren        Le numéro siren du producteur
	 * @param  string  $region       La région du producteur, qui détermine aussi la région de tous ses futurs produits
	 * @param  string  $address      L'adresse du lieu de travail du producteur
	 * @param  int     $postcode     Le code postal du lieu de travail du producteur
	 * @param  string  $city         La ville du lieu de travail du producteur
	 * @param  decimal $lng          La longitude du lieu de travail du producteur
	 * @param  decimal $lat          La latitude du lieu de travail du producteur
	 * @param  array   $error        Un tableau contenant les erreurs potentielles rencontrées à la validation du formulaire
	 *
	 * @return void
	 */
	public function registerWinemaker($token, $siren, $region, $address, $postcode, $city, $tel, $lng, $lat, &$error)
	{
		if ($this->sirenExists($siren)) {
			$error['siren'] = 'Ce numéro siren est déjà enregistré.';
			return;
		}

		$user = new UserModel();

		$winemaker = $user->getUserByToken($token);

		$data = array(
			'winemaker_id' => $winemaker['id'],
			'siren'        => $siren,
			'region'       => $region,
			'tel'		   => $tel,
			'address'      => $address,
			'postcode'     => $postcode,
			'city'         => $city,
			'lng'          => $lng,
			'lat'          => $lat
		);

		$this->insert($data);

		// On met à jour le champ 'type' de l'utilisateur
		$user->update(array('type' => 1), $winemaker['id']);

		// Puis on refresh sa sessipn
		$auth = new AuthentificationModel();
		$auth->refreshUser();
	}

	/**
	 * Modifie un profil producteur
	 *
	 * @param  string  $token        Le token de l'utilisateur, dont on se sert pour déterminer son id
	 * @param  string  $region       La région du producteur, qui détermine aussi la région de tous ses futurs produits
	 * @param  string  $address      L'adresse du lieu de travail du producteur
	 * @param  int     $postcode     Le code postal du lieu de travail du producteur
	 * @param  string  $city         La ville du lieu de travail du producteur
	 * @param  decimal $lng          La longitude du lieu de travail du producteur
	 * @param  decimal $lat          La latitude du lieu de travail du producteur
	 * @param  array   $error        Un tableau contenant les erreurs potentielles rencontrées à la validation du formulaire
	 *
	 * @return void
	 */
	public function updateProfile($token, $region, $address, $tel, $postcode, $city, $lng, $lat, &$error)
	{
		$userModel = new UserModel();
		$auth      = new AuthentificationModel;

		$user = $userModel->getUserByToken($token);

		$data = array(
			'region'   => $region,
			'address'  => $address,
			'tel'	   => $tel,
			'postcode' => $postcode,
			'city'     => $city,
			'lng'      => $lng,
			'lat'      => $lat
		);

		$this->update($data, $user['id']);
		$auth->refreshUser();
	}

	/**
	 * Récupère, via une jointure, les informations d'utilisateur et de producteur de tous les producteurs
	 *
	 * @return [array]   Un array contenant les informations complètes (d'utilisateur et de producteur) de tous les producteurs
	 */
	public function getWinemakersFullDetails()
	{
		$sql = 'SELECT *
			FROM users
			RIGHT JOIN '.$this->table.' ON users.id = '.$this->table.'.winemaker_id
			WHERE users.type = 1 ';
		$sth = $this->dbh->prepare($sql);
		$sth->execute();

		return $sth->fetchAll();
	}

	/**
	 * Récupère, via une jointure, les informations d'utilisateur et de producteur d'un producteur spécifique
	 *
	 * @param  [string] $token    Le token de l'utilisateur, dont on se sert pour déterminer son id
	 *
	 * @return [array]            Un array contenant les informations complètes (d'utilisateur et de producteur) du producteur recherché
	 */
	public function getWinemakerFullDetails($token)
	{
		$userModel = new UserModel();

		$winemaker = $userModel->getUserByToken($token);

		$sql = 'SELECT *
			FROM users
			RIGHT JOIN ' . $this->table . '
				ON users.id = ' . $this->table . '.winemaker_id
			WHERE users.type = 1
			 	AND ' . $this->table . '.winemaker_id = :winemaker_id';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':winemaker_id', $winemaker['id']);
		$sth->execute();

		return $sth->fetch();
	}

	/**
	 * Récupère la latitude et la longitude d'un producteur afin de pouvoir l'afficher sur la googlemap
	 *
	 * @return [array] $winemakers Un tableau ne contenant que la latitude et la longitude du producteur
	 */
	public function latlng() {
		$winemakerModel  = new WinemakerModel();

		$winemakers = $this->findAll('lat, lng');

		return $winemakers;
	}

	/**
	 * Vérifie si un utilisateur est bien un producteur
	 *
	 * @param  string   $token        Le token de l'utilisateur, dont on se sert pour déterminer son id
	 *
	 * @return boolean                Vrai si l'utilisateur est producteur, faux s'il n'est pas producteur
	 */
	public function isAWineMaker($token)
	{
		$userModel = new UserModel();

		$user = $userModel->getUserByToken($token);

		$sql = 'SELECT ' . $this->primaryKey . ' FROM ' . $this->table . ' WHERE winemaker_id = :winemaker_id LIMIT 1';
		$dbh = ConnectionModel::getDbh();
		$sth = $dbh->prepare($sql);
		$sth->bindValue(':winemaker_id', $user['id']);

		if($sth->execute()){
			$foundWinemaker = $sth->fetch();
			if($foundWinemaker){
				return true;
			}
		}
		return false;
	}

	/**
	 * Teste si un numéro siren est présent en base de données
	 *
	 * @param [string]   $siren Le numéro à tester
	 *
	 * @return [boolean] Vrai si le numéro siren est déjà existant, faux sinon
	 */
	public function sirenExists($siren)
	{
		$sql = 'SELECT siren FROM ' . $this->table . ' WHERE siren = :siren LIMIT 1';
		$dbh = ConnectionModel::getDbh();
		$sth = $dbh->prepare($sql);
		$sth->bindValue(':siren', $siren);
		if($sth->execute()){
			$foundSiren = $sth->fetch();
			if($foundSiren){
				return true;
			}
		}
		return false;
	}

}
