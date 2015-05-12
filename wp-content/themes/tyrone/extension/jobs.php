<?php 



add_action( 'init', 'codex_jobs_init' );

add_action('add_meta_boxes_job', 'jobs_box');

add_action('save_post', 'save_jobs_custom', 10, 2);

/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */

function codex_jobs_init() {
	$labels = array(
		'name'               => _x( 'Empleos', 'jobs', 'jobs' ),
		'singular_name'      => _x( 'Empleo', 'job', 'jobs' ),
		'menu_name'          => _x( 'Empleos', 'admin menu', 'jobs' ),
		'name_admin_bar'     => _x( 'Empleo', 'add new on admin bar', 'jobs' ),
		'add_new'            => _x( 'Agregar nuevo', 'job', 'jobs' ),
		'add_new_item'       => __( 'Agregar nuevo empleo', 'jobs' ),
		'new_item'           => __( 'Nuevo empleo', 'jobs' ),
		'edit_item'          => __( 'Editar empleo', 'jobs' ),
		'view_item'          => __( 'Ver empleo', 'jobs' ),
		'all_items'          => __( 'Todos los empleos', 'jobs' ),
		'search_items'       => __( 'Buscar empleo', 'jobs' ),
		'not_found'          => __( 'No se encontraron empleos.', 'jobs' ),
		'not_found_in_trash' => __( 'No se encontraron empleos en papelera.', 'jobs' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'job' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array('title')
	);

	register_post_type( 'job', $args );
}

function jobs_box() {

    add_meta_box( 
    	'jobs-box', 
    	__('Empleo'), 
    	'jobs_box_form', 
    	'job', 
    	'advanced', 
    	'high', 
    	[] 
    );
}

function jobs_box_form( $post, $args = [] ) {

	wp_nonce_field( 'job_meta_box', 'job_meta_box_noncename' );

    $post_meta = get_post_custom($post->ID);

    $fields = [
    	'job' => [
    		'label' =>  "Puesto"
    	],
    	'job_company' => [
    		'label' =>  "Empresa"
    	],
    	'job_description' => [
    		'label' =>  "Descripción",
    		'type' => 'textarea'
    	],
    	'job_city' => [
    		'label' =>  "Ciudad"
    	],
    	'job_init_date' => [
    		'label' =>  "Fecha de inicio",
    		'type' => 'date'
    	],
    	'job_current' => [
    		'label' => 'Actual',
    		'type' => 'checkbox'
    	],
    	'job_end_date' => [
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

function save_jobs_custom( $post_id){

	if ( 'job' == $post->post_type ) {
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    if ( !isset( $_POST['job_meta_box_noncename'] ) || ! wp_verify_nonce( $_POST['job_meta_box_noncename'], 'job_meta_box' ) ) {
        return;
    }

    $fields = [
    	'job',
    	'job_company',
    	'job_description',
    	'job_city',
    	'job_init_date',
    	'job_current',
    	'job_end_date',
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