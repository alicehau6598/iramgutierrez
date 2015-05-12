<?php
/**
 * EMS 2014 functions and definitions
 *
 */



add_theme_support( 'post-thumbnails' ); 

include 'theme_customizer.php';

include "extension/hobbies.php";

include "extension/facts.php";

include "extension/jobs.php";


function wp_strtoupper($string) {

	return strtr(strtoupper($string),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ");

}

function get_date($date = false , $format = 'Y-m-d')
{
	$date = strtotime($date);

	if(!$date)
		return $date;

	$year = date($format , $date);

	return $year;
}

?>