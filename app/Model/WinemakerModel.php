<?php
namespace Model;

use \W\Model\Model;

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

	public function addWinemaker($user_id)
	{

	}

}
