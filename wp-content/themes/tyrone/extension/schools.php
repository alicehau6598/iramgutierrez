<?php 



add_action( 'init', 'codex_schools_init' );

add_action('add_meta_boxes_school', 'schools_box');

add_action('save_post', 'save_schools_custom', 10, 2);

/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */

function codex_schools_init() {
	$labels = array(
		'name'               => _x( 'Escuelas', 'schools', 'schools' ),
		'singular_name'      => _x( 'Escuela', 'school', 'schools' ),
		'menu_name'          => _x( 'Escuelas', 'admin menu', 'schools' ),
		'name_admin_bar'     => _x( 'Escuela', 'add new on admin bar', 'schools' ),
		'add_new'            => _x( 'Agregar nueva', 'school', 'schools' ),
		'add_new_item'       => __( 'Agregar nueva escuela', 'schools' ),
		'new_item'           => __( 'Nueva escuela', 'schools' ),
		'edit_item'          => __( 'Editar escuela', 'schools' ),
		'view_item'          => __( 'Ver escuela', 'schools' ),
		'all_items'          => __( 'Todas las escuelas', 'schools' ),
		'search_items'       => __( 'Buscar escuela', 'schools' ),
		'not_found'          => __( 'No se encontraron escuelas.', 'schools' ),
		'not_found_in_trash' => __( 'No se encontraron escuelas en papelera.', 'schools' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'school' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array('title')
	);

	register_post_type( 'school', $args );
}

function schools_box() {

    add_meta_box( 
    	'schools-box', 
    	__('Escuela'), 
    	'schools_box_form', 
    	'school', 
    	'advanced', 
    	'high', 
    	[] 
    );
}

function schools_box_form( $post, $args = [] ) {

	wp_nonce_field( 'school_meta_box', 'school_meta_box_noncename' );

    $post_meta = get_post_custom($post->ID);

    $fields = [
    	'school_degree' => [
    		'label' =>  "Titulo obtenido"
    	],
    	'school' => [
    		'label' =>  "Escuela"
    	],
    	'school_description' => [
    		'label' =>  "Descripción",
    		'type' => 'textarea'
    	],
    	'school_city' => [
    		'label' =>  "Ciudad"
    	],
    	'school_init_date' => [
    		'label' =>  "Fecha de inicio",
    		'type' => 'date'
    	],
    	'school_current' => [
    		'label' => 'Actual',
    		'type' => 'checkbox'
    	],
    	'school_end_date' => [
    		'label' =>  "Fecha de fin",
    		'type' => 'date'
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

function save_schools_custom( $post_id){

	if ( 'school' == $post->post_type ) {
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    if ( !isset( $_POST['school_meta_box_noncename'] ) || ! wp_verify_nonce( $_POST['school_meta_box_noncename'], 'school_meta_box' ) ) {
        return;
    }

    $fields = [
    	'school_degree',
    	'school',
    	'school_description',
    	'school_city',
    	'school_init_date',
    	'school_current',
    	'school_end_date',
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

?>