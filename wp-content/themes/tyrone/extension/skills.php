<?php 



add_action( 'init', 'codex_skills_init' );

add_action('add_meta_boxes_skill', 'skills_box');

add_action('save_post', 'save_skills_custom', 10, 2);

/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */

function codex_skills_init() {
	$labels = array(
		'name'               => _x( 'Habilidades', 'skills', 'skills' ),
		'singular_name'      => _x( 'Habilidad', 'skill', 'skills' ),
		'menu_name'          => _x( 'Habilidades', 'admin menu', 'skills' ),
		'name_admin_bar'     => _x( 'Habilidad', 'add new on admin bar', 'skills' ),
		'add_new'            => _x( 'Agregar nueva', 'skill', 'skills' ),
		'add_new_item'       => __( 'Agregar nueva habilidad', 'skills' ),
		'new_item'           => __( 'Nueva habilidad', 'skills' ),
		'edit_item'          => __( 'Editar habilidad', 'skills' ),
		'view_item'          => __( 'Ver habilidad', 'skills' ),
		'all_items'          => __( 'Tados las habilidades', 'skills' ),
		'search_items'       => __( 'Buscar habilidad', 'skills' ),
		'not_found'          => __( 'No se encontraron habilidades.', 'skills' ),
		'not_found_in_trash' => __( 'No se encontraron habilidades en papelera.', 'skills' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'skill' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array('title')
	);

	register_post_type( 'skill', $args );
}

function skills_box() {

    add_meta_box( 
    	'skills-box', 
    	__('habilidad'), 
    	'skills_box_form', 
    	'skill', 
    	'advanced', 
    	'high', 
    	[] 
    );
}

function skills_box_form( $post, $args = [] ) {

	wp_nonce_field( 'skill_meta_box', 'skill_meta_box_noncename' );

    $post_meta = get_post_custom($post->ID);

    $fields = [
    	'skill_technology' => [
    		'label' =>  "Tecnología"
    	],
    	'skill_level' => [
    		'label' =>  "Nivel"
    	],
    	'skill_experience' => [
    		'label' =>  "Experiencia"
    	],
    	'skill_percent' => [
    		'label' =>  "Porcentaje"
    	],
    ];

    foreach($fields as $field => $args)
    {

    	$value = (!empty($post_meta[$field][0])) ? $post_meta[$field][0] : ''; 
    
	    ?>
	    <div style="width: 600px; " class="divForm" >
	        <label  class="label col-sm-12" for="<?php echo $field; ?>"><?php _e($args['label']); ?></label>
	    </div>
	    <div style="width: 600px; " class="divForm" >
	    	<?php 
	    	if( in_array($args['type'] , ['text' , 'email' , 'password' , 'date']) )
	    	{
	    	?>
	        	<input name="<?php echo $field; ?>" id="<?php echo $field; ?>" type="<?php echo $args['type']; ?>" value="<?php echo $value; ?>">
	        <?php
	    	}else if($args['type'] == 'checkbox')
	    	{ 
	    	?>
	        	<input name="<?php echo $field; ?>" id="<?php echo $field; ?>" type="<?php echo $args['type']; ?>" <?php if($value){ echo 'checked'; } ?> >
	        
	    	<?php
	    	}else if($args['type'] == 'textarea')
	    	{
	    	?>
	    		<textarea name="<?php echo $field; ?>" ><?php echo $value; ?></textarea>
	    	<?php
	    	}else
	    	{
	    	?>
	        	<input name="<?php echo $field; ?>" id="<?php echo $field; ?>" type="text" value="<?php echo $value; ?>">
	    	<?php
	    	}
	    	?>
	    </div>
	    <?php

    }

}

function save_skills_custom( $post_id){

	if ( 'skill' == $post->post_type ) {
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    if ( !isset( $_POST['skill_meta_box_noncename'] ) || ! wp_verify_nonce( $_POST['skill_meta_box_noncename'], 'skill_meta_box' ) ) {
        return;
    }

    $fields = [
    	'skill_technology',
    	'skill_level',
    	'skill_experience',
    	'skill_percent',
    ];

    foreach($fields as $field)
    {

	    if( isset($_POST[$field]) && $_POST[$field] != "" ) {
	        update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
	    } else {if ( isset( $post_id ) ) {
	            delete_post_meta($post_id, $field);
	        }
	    }

    }

}

// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_skill_taxonomies', 0 );

// create two taxonomies, genres and writers for the post type "book"
function create_skill_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Categoría de habilidades', 'skill_category' ),
		'singular_name'     => _x( 'skill_category', 'skill_category' ),
		'search_items'      => __( 'Buscar categoría de habilidades' ),
		'all_items'         => __( 'Todas las categorías de habilidades' ),
		'parent_item'       => __( 'Categoría de habilidades padre' ),
		'parent_item_colon' => __( 'Categoría de habilidades padre:' ),
		'edit_item'         => __( 'Editar categoría de habilidades:' ),
		'update_item'       => __( 'Actualizar categoría de habilidades' ),
		'add_new_item'      => __( 'Agregar categoría de habilidades' ),
		'new_item_name'     => __( 'Nuevo nombre de categoría de habilidades' ),
		'menu_name'         => __( 'Categoría de habilidades' ),
	);

	$args = array(
		'labels'            => $labels,
		'show_ui'           => true,
		'hierarchical' => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 
			'slug' => 'skill_category' 
		)
	);

	register_taxonomy( 'skill_category', array( 'skill' ), $args );

}

?>