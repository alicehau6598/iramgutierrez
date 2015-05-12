<?php 



add_action( 'init', 'codex_hobbies_init' );

add_action('add_meta_boxes_hobby', 'hobbies_box');

add_action('save_post', 'save_hobby_custom', 10, 2);

/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */

function codex_hobbies_init() {
	$labels = array(
		'name'               => _x( 'Hobbies', 'hobbies', 'hobbies' ),
		'singular_name'      => _x( 'Hobby', 'hobby', 'hobbies' ),
		'menu_name'          => _x( 'Hobbies', 'admin menu', 'hobbies' ),
		'name_admin_bar'     => _x( 'Hobby', 'add new on admin bar', 'hobbies' ),
		'add_new'            => _x( 'Agregar nuevo', 'hobby', 'hobbies' ),
		'add_new_item'       => __( 'Agregar nuevo hobby', 'hobbies' ),
		'new_item'           => __( 'Nuevo hobby', 'hobbies' ),
		'edit_item'          => __( 'Editar hobby', 'hobbies' ),
		'view_item'          => __( 'Ver hobby', 'hobbies' ),
		'all_items'          => __( 'Todos los hobbies', 'hobbies' ),
		'search_items'       => __( 'Buscar hobby', 'hobbies' ),
		'not_found'          => __( 'No se encontraron hobbies.', 'hobbies' ),
		'not_found_in_trash' => __( 'No se encontraron hobbies en papelera.', 'hobbies' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'hobby' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array('title','editor')
	);

	register_post_type( 'hobby', $args );
}

function hobbies_box() {

    add_meta_box( 
    	'hobbies-box', 
    	__('Hobby'), 
    	'hobbies_box_form', 
    	'hobby', 
    	'side', 
    	'high', 
    	[] 
    );
}

function hobbies_box_form( $post, $args = [] ) {

	wp_nonce_field( 'hobby_meta_box', 'hobby_meta_box_noncename' );

    $post_meta = get_post_custom($post->ID);

    $icon = (!empty($post_meta['hobby_icon'][0])) ? $post_meta['hobby_icon'][0] : ''; 
     
    ?>
    <p>
        <label class="label" for="hobby_icon"><?php _e("Icono de Font Awesome: "); ?></label>
        <input  name="hobby_icon" id="hobby_icon" type="text" value="<?php echo $icon; ?>">
    </p>
    <?php

}

function save_hobby_custom( $post_id){

	if ( 'hobby' == $post->post_type ) {
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    if ( !isset( $_POST['hobby_meta_box_noncename'] ) || ! wp_verify_nonce( $_POST['hobby_meta_box_noncename'], 'hobby_meta_box' ) ) {
        return;
    }

    if( isset($_POST['hobby_icon']) && $_POST['hobby_icon'] != "" ) {
        update_post_meta( $post_id, 'hobby_icon', sanitize_text_field( $_POST['hobby_icon'] ) );
    } else {if ( isset( $post_id ) ) {
            delete_post_meta($post_id, 'hobby_icon');
        }
    }

}

?>