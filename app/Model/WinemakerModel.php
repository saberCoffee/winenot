<?php
namespace Model;

use \W\Model\Model;

use \Model\TokenModel;

class WinemakerModel extends Model
{

	protected $primaryKey = 'winemakers_id';

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

	public function registerWinemaker($id, $siren, $area, $address, $cp, $city, $lng, $lat, &$error)
	{
		if ($this->sirenExists($siren)) {
			$error['siren'] = 'Ce numéro siren est déjà enregistré.';
			return;
		}

		$token = new TokenModel();

		$data = array(
			'id'        => $id,
			'email'     => $email,
			'password'  => $hashedPassword,
			'firstname' => $firstname,
			'lastname'  => $lastname
		);

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
