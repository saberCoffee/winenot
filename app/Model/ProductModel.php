<?php
namespace Model;

use \W\Model\Model;
use \W\Security\StringUtils;

use \Model\UserModel;

class ProductModel extends Model
{

	/**
	 * Cette fonction insert les produits du producteur dans la bdd.
	 *
	 * @param 	int $product  	nom du produit
	 * @param 	int $color    	couleur du vin
	 * @param 	int $price    	tarif de la bouteille
	 * @param 	int $millesime  l'année
	 * @param 	int $cepage   	cépage du vin
	 * @param 	int $stock    	si c'est en stock
	 * @param 	int $bio    	si le vin est bio
	 *
	 * @return void
	 */
	public function addProduct($token, $name, $color, $region, $price, $description, $millesime, $cepage, $stock, $bio, $photo)
	{
		$user = new UserModel();

		$winemaker_id = $user->getUserByToken($token);

		$data = array(
			'name'		   => $name,
			'couleur'	   => $color,
			'region'       => $region,
			'price'   	   => $price,
			'description'  => $description,
			'millesime'    => $millesime,
			'cepage' 	   => $cepage,
			'stock' 	   => $stock,
			'is_bio' 	   => $bio,
			'photo'        => $photo,
			'winemaker_id' => $winemaker_id['id']
		);

		return $this->insert($data);
	}

	public function editProduct($idProduct, $price, $description, $photo, $stock)
	{
		$data = array(
			'price'       => $price,
			'description' => $description,
			'stock'       => $stock
		);

		if (!empty($photo)) { // Si l'utilisateur upload une nouvelle photo, on change l'ancienne et on la supprime
			$data['photo'] = $photo;

			$sql = "SELECT photo FROM " . $this->table . " WHERE id = " . $idProduct;

			$sth = $this->dbh->prepare($sql);
			$sth->execute();

			$oldPhoto = $sth->fetch();

			$filepath = 'assets/content/products/' . $oldPhoto['photo'];

	        unlink($filepath);
		}

		return $this->update($data, $idProduct);
	}

	/**
	 * Retourne tous les produits d'un producteurs
	 *
	 * @param  int     $winemaker_id   L'id d'un producteur
	 *
	 * @return array                   Un array contenant toutes les informations des produits d'un producteur
	 */
	public function findProductsFrom($winemaker_id)
	{
		$sql = 'SELECT * FROM ' . $this->table . ' WHERE winemaker_id = :winemaker_id';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':winemaker_id', $winemaker_id);

		$sth->execute();

		return $sth->fetchAll();
	}

	/**
	 * Sélectionne les vins du mois
	 *
	 * @param array    $products Un tableau contenant l'id des produits sélectionnés
	 *
	 * @return void
	 */
	public function setWinesOfTheMonth($products)
	{
		// Avant d'inscrire les vins du mois à la BDD, on doit retirer les anciens
		// Pour cela, on sélectionne tous les vins du mois...
		$sql = "SELECT id FROM $this->table WHERE wine_of_the_month = 1";
		$sth = $this->dbh->prepare($sql);
		$sth->execute();

		// ... Puis on remet chaque vin à 0 dans la colonne "wine_of_the_month"
		$currentProducts = $sth->fetchAll();
		foreach ($currentProducts as $product)
		{
			$data = array(
				'wine_of_the_month' => 0
			);

			$this->update($data, $product['id']);
		}

		// Pour chaque produit sélectionné dans le formulaire (donc les nouveaux vins du mois), on change la colonne "wine_of_the_month" à 1
		foreach ($products as $product)
		{
			$data = array(
				'wine_of_the_month' => 1
			);

			$this->update($data, $product);
		}
	}

	/**
	 * Récupère les vins du mois ainsi que le producteur de chaque vin et ses informations
	 *
	 * @return array   $products     Les vins du mois
	 */
	public function getWinesOfTheMonth()
	{
		$userModel      = new UserModel();
		$winemakerModel = new WinemakerModel();

		$sql = 'SELECT * FROM ' . $this->table . ' WHERE wine_of_the_month = 1';

		$sth = $this->dbh->prepare($sql);

		$sth->execute();

		$products = $sth->fetchAll();

		$i = 0;
		foreach ($products as $product) {
			$token = $userModel->getTokenByUserId($product['winemaker_id']);

			$products[$i]['winemaker'] = $winemakerModel->getWinemakerFullDetails($token);
			// Pour créer un lien avec le nom du produit dans l'url, on doit créer une version clean du nom du produit
			$products[$i]['clean_name'] = StringUtils::clean_url($products[$i]['name']);

			++$i;
		}

		return $products;
	}

}
