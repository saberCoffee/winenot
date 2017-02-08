<?php
namespace Model;

use \W\Model\Model;
use \W\Model\ConnectionModel;

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
	public function registerWinemaker($token, $siren, $domain, $address, $postcode, $city, $lng, $lat, &$error)
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
			'domain'      => $domain,
			'address'     => $address,
			'postcode'    => $postcode,
			'city'        => $city,
			'lng'         => $lng,
			'lat'         => $lat,
		);

		$user->update(array('type' => 1), $winemaker_id['id']);
		$this->insert($data);
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
			$foundUser = $sth->fetch();
			if($foundUser){
				return true;
			}
		}
		return false;
	}

}
