<?php
namespace Model;

use \W\Model\Model;

class WinemakerModel extends Model 
{

	public function winemakers() {
	
		$winemakers = new UserModel();
		$winemakers = $winemakers->findAll();
	
		if(isset($_GET['id'])){
			$winemaker = new UserModel();
			$winemaker = $winemaker->find($_GET['winemakers_id']);
	
		}
	}
	
	public function latlng() {
		
		$winemaker = new WinemakerModel();
		$winemakers = $this->findAll('lat, lng');
		
		return $winemakers;
		
	}
	
}