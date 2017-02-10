<?php

namespace W\Security;

/**
 * Fonctions sécuritaires et utiles sur les chaînes
 */
class StringUtils
{

	/**
	 * Retourne un chaîne aléatoire sécuritaire, url safe
	 * @param  integer $length Longeur de la chaîne à générer
	 * @return string $string La chaîne générée
	 */
	public static function randomString($length = 80)
	{
		$possibleChars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_-';
        $factory = new \RandomLib\Factory;
		$generator = $factory->getGenerator(new \SecurityLib\Strength(\SecurityLib\Strength::MEDIUM));
		$string = $generator->generateString($length, $possibleChars);

        return $string;
	}

	public static function clean_url($string, $charset='utf-8')
	{
	    $string = htmlentities($string, ENT_NOQUOTES, $charset);

	    $string = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $string);
	    $string = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $string);
	    $string = preg_replace('#&[^;]+;#', '', $string);

		$string = strtolower(str_replace(' ', '-', $string));
  	  	preg_replace('/[^A-Za-z0-9\-]/', '', $string);

	    return $string;
	}

}
