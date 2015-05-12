<?php
new theme_customizer();

class theme_customizer
{
    public function __construct()
    {
        add_action ('admin_menu', array(&$this, 'customizer_admin'));
        add_action( 'customize_register', array(&$this, 'customize_manager_vitem' ));
        //add_action( 'customize_register', array(&$this, 'customize_manager_demo2' ));
    }

    /**
     * Add the Customize link to the admin menu
     * @return void
     */
    public function customizer_admin() {
        add_theme_page( 'Customize', 'Customize', 'edit_theme_options', 'customize.php' );
    }

    /**
     * Customizer manager demo
     * @param  WP_Customizer_Manager $wp_manager
     * @return void
     */
    public function customize_manager_vitem( $wp_manager )
    {
        $this->Vitem( $wp_manager );
    }


    public function Vitem( $wp_manager )
    {

    	/* Home slider */

        $wp_manager->add_section( 'general', array(
	            'title'          => 'General',
	            'priority'       => 1,
	        ) 
        );

        $wp_manager->add_setting( 'video_youtube_id', array(
	            'default'        => '',
	        ) 
        );

        $wp_manager->add_control( 'video_youtube_id', array(
	            'label'   => 'Id de video en tarjeta',
	            'section' => 'general',
	            'type'    => 'text',
	            'priority' => 1
	        ) 
        );

        $wp_manager->add_section( 'contact', array(
	            'title'          => 'Contacto',
	            'priority'       => 2,
	        ) 
        );
        
        $wp_manager->add_setting( 'email_contact', array(
	            'default'        => '',
	        ) 
        );

        $wp_manager->add_control( 'email_contact', array(
	            'label'   => 'Email de contacto',
	            'section' => 'contact',
	            'type'    => 'text',
	            'priority' => 1
	        ) 
        );
        
        $wp_manager->add_setting( 'phone_contact', array(
            	'default'        => '',
        	) 
        );

        $wp_manager->add_control( 'phone_contact', array(
	            'label'   => 'Teléfono de contacto',
	            'section' => 'contact',
	            'type'    => 'text',
	            'priority' => 2
        	) 
        );

        $wp_manager->add_section( 'map', array(
	            'title'          => 'Mapa',
	            'priority'       => 3,
	        ) 
        );
        
        $wp_manager->add_setting( 'latitude', array(
	            'default'        => '',
	        ) 
        );

        $wp_manager->add_control( 'latitude', array(
	            'label'   => 'Latitud',
	            'section' => 'map',
	            'type'    => 'text',
	            'priority' => 1
	        ) 
        );
        
        $wp_manager->add_setting( 'longitude', array(
	            'default'        => '',
	        ) 
        );

        $wp_manager->add_control( 'longitude', array(
	            'label'   => 'Longitud',
	            'section' => 'map',
	            'type'    => 'text',
	            'priority' => 2
	        ) 
        );
        
        $wp_manager->add_setting( 'place', array(
	            'default'        => '',
	        ) 
        );

        $wp_manager->add_control( 'place', array(
	            'label'   => 'Lugar',
	            'section' => 'map',
	            'type'    => 'text',
	            'priority' => 3
	        ) 
        );
    }
   

}

?>