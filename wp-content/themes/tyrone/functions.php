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

include "extension/schools.php";

include "extension/skills.php";


function wp_strtoupper($string) {

	return strtr(strtoupper($string),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ");

}

function get_date($date = false , $format = 'Y-m-d')
{
	$date = strtotime($date);

	if(!$date)
		return $date;

	$new = date($format , $date);

	return $new;
}

function get_skills()
{

	$taxonomies = array( 
	    'skill_category',    
	);

	$args = array(
	    'orderby'           => 'name', 
	    'order'             => 'DESC',
	    'hide_empty'        => true, 
	    'exclude'           => array(), 
	    'exclude_tree'      => array(), 
	    'include'           => array(),
	    'number'            => '', 
	    'fields'            => 'all', 
	    'slug'              => '',
	    'parent'            => '',
	    'hierarchical'      => true, 
	    'child_of'          => 0,
	    'childless'         => false,
	    'get'               => '', 
	    'name__like'        => '',
	    'description__like' => '',
	    'pad_counts'        => false, 
	    'offset'            => '', 
	    'search'            => '', 
	    'cache_domain'      => 'core'
	); 

	//$categories = get_terms($taxonomies, $args);

	$categories = [
	    'backend',
	    'frontend',
	    'frameworks-php',
	    'librerias-y-frameworks-javascript',
	    'cms',
	    'crm',
	    'frameworks-de-maquetacion',
	    'pre-procesadores-css'
	];

	$skills = [];

	foreach($categories as $category)
	{  

	    $cat = get_term_by('slug', $category, 'skill_category'); 
	                            
	    if($cat) {

	        $args = [
	            'post_type' => 'skill',
	            'meta_key'=>'skill_percent',  
	            'orderby' => 'meta_value_num',
	            'order' => 'desc',
	            'tax_query' => [
	                [
	                    'taxonomy' => 'skill_category',
	                    'field' => 'slug',
	                    'terms' => [$category]
	                ]
	            ],
	        ];

	        $posts = new WP_Query($args);

	        if($posts->have_posts())
	        {
	            $skills[$category] = [
	                'category' => $cat, 
	                'posts' => $posts
	            ];
	        }

	    }

	}

	return $skills;

}

?>