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
	 * Récupère la latitude et la longitude d'un producteur afin de pouvoir l'afficher sur la googlemap
	 *
	 * @return $array Un tableau ne contenant que la latitude et la longitude
	 */
	public function latlng() {
		$winemaker = new WinemakerModel();
		$winemakers = $this->findAll('lat, lng');

		return $winemakers;
	}

	/**
	 * [registerWinemaker description]
	 *
	 * @param  [type] $id      [description]
	 * @param  [type] $siren   [description]
	 * @param  [type] $area    [description]
	 * @param  [type] $address [description]
	 * @param  [type] $cp      [description]
	 * @param  [type] $city    [description]
	 * @param  [type] $lng     [description]
	 * @param  [type] $lat     [description]
	 * @param  [type] $error   [description]
	 *
	 * @return void
	 */
	public function registerWinemaker($token, $siren, $region, $address, $postcode, $city, $lng, $lat, &$error)
	{
		if ($this->sirenExists($siren)) {
			$error['siren'] = 'Ce numéro siren est déjà enregistré.';
			return;
		}

		$user = new UserModel();

		$winemaker_id = $user->getUserByToken($token);

		$data = array(
			'winemaker_id'=> $winemaker_id['id'],
			'siren'       => $siren,
			'region'      => $region,
			'address'     => $address,
			'postcode'    => $postcode,
			'city'        => $city,
			'lng'         => $lng,
			'lat'         => $lat,
		);

		$this->insert($data);

		// On met à jour le champ 'type' de l'utilisateur
		$user->update(array('type' => 1), $winemaker_id['id']);

		// Puis on refresh sa sessopn
		$auth = new AuthentificationModel();
		$auth->refreshUser();
	}

	/**
	 * Teste si un numéro siren est présent en base de données
	 *
	 * @param string $siren Le numéro à tester
	 *
	 * @return boolean true si présent en base de données, false sinon
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

	/**
	 * Vérifie si un utilisateur est bien un producteur
	 *
	 * @param  string $token Le token de la session de l'utilisateur
	 * @return boolean        [description]
	 */
	public function isAWineMaker($token)
	{
		$user = new UserModel();

		$winemaker_id = $user->getUserByToken($token);

		$sql = 'SELECT winemaker_id FROM ' . $this->table . ' WHERE winemaker_id = :winemaker_id LIMIT 1';
		$dbh = ConnectionModel::getDbh();
		$sth = $dbh->prepare($sql);
		$sth->bindValue(':winemaker_id', $winemaker_id['id']);
		if($sth->execute()){
			$foundWinemaker = $sth->fetch();
			if($foundWinemaker){
				return true;
			}
		}
		return false;
	}
	
	public function getWinemakerbyUser()
	{
		$user = new UserModel();
		$winemaker_id = $user->getUserByToken($token);
		
		$sql = 'SELECT *
			FROM users
			RIGHT JOIN '.$this->table.' ON users.id = '.$this->table.'.winemaker_id
			WHERE users.type = 1';
		$sth = $this->dbh->prepare($sql);
		$sth->execute();
		
		return $sth->fetchAll();
		
	}

}









