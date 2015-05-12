<?php 



add_action( 'init', 'codex_facts_init' );

add_action('add_meta_boxes_fact', 'facts_box');

add_action('save_post', 'save_facts_custom', 10, 2);

/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */

function codex_facts_init() {
	$labels = array(
		'name'               => _x( 'Logros', 'facts', 'facts' ),
		'singular_name'      => _x( 'Logro', 'fact', 'facts' ),
		'menu_name'          => _x( 'Logros', 'admin menu', 'facts' ),
		'name_admin_bar'     => _x( 'Logro', 'add new on admin bar', 'facts' ),
		'add_new'            => _x( 'Agregar nuevo', 'fact', 'facts' ),
		'add_new_item'       => __( 'Agregar nuevo logro', 'facts' ),
		'new_item'           => __( 'Nuevo logro', 'facts' ),
		'edit_item'          => __( 'Editar logro', 'facts' ),
		'view_item'          => __( 'Ver logro', 'facts' ),
		'all_items'          => __( 'Todos los logros', 'facts' ),
		'search_items'       => __( 'Buscar logro', 'facts' ),
		'not_found'          => __( 'No se encontraron logros.', 'facts' ),
		'not_found_in_trash' => __( 'No se encontraron logros en papelera.', 'facts' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'fact' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array('title')
	);

	register_post_type( 'fact', $args );
}

function facts_box() {

    add_meta_box( 
    	'facts-box', 
    	__('Logro'), 
    	'facts_box_form', 
    	'fact', 
    	'advanced', 
    	'high', 
    	[] 
    );
}

function facts_box_form( $post, $args = [] ) {

	wp_nonce_field( 'fact_meta_box', 'fact_meta_box_noncename' );

    $post_meta = get_post_custom($post->ID);

    $fields = [
    	'fact_quantity' => [
    		'label' =>  "Cantidad: "
    	],
    	'fact_icon' => [
    		'label' =>  "Icono de Font Awesome: "
    	]
    ];

    foreach($fields as $field => $args)
    {

    	$value = (!empty($post_meta[$field][0])) ? $post_meta[$field][0] : ''; 
    
	    ?>
	    <div class="divForm">
	        <label class="label" for="<?php echo $field; ?>"><?php _e($args['label']); ?></label>
	        <input  name="<?php echo $field; ?>" id="<?php echo $field; ?>" type="text" value="<?php echo $value; ?>">
	    </div>
	    <?php

    }

}

function save_facts_custom( $post_id){

	if ( 'fact' == $post->post_type ) {
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    if ( !isset( $_POST['fact_meta_box_noncename'] ) || ! wp_verify_nonce( $_POST['fact_meta_box_noncename'], 'fact_meta_box' ) ) {
        return;
    }

    $fields = [
    	'fact_quantity',
    	'fact_icon'
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