<?php
/**
 * Customizer controls and options
 * 
 * @package WordPress
 */
    
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}


class Customizer_Options {

    /**
     * Construct class functions and constants
     * 
     * @since 1.0
     */
    public function __construct()
    {

        // Register all the customizer options and sections 
        add_action('customize_register', array($this, 'register_options'));
    }

    /**
     * Register all customizer options
     * 
     * @since 1.0
     */
    public function register_options($wp_customize)
    {

        /**
         * Panel
         */
        $panel = 'options_panel';
        $wp_customize->add_panel(
            $panel,
            array(
                'title'    => __('Opções GPR'),
                'priority' => 10,
            )
        );
        

        /**
         * ------------------- Section ----------------
         */
        $section = 'footer_options';
        $wp_customize->add_section(
            $section,
            array(
                'title'    => __('Rodapé'),
                'priority' => 10,
                'panel'    => $panel,
            )
        );

        /**
         *  WhatsApp No.
         */
        $wp_customize->add_setting(
            'footer_logo',
            array(
                'default' => ''
            )
        );
       
        Kirki::add_field( 
            'title_footer_logo',
            array(
                'type'      => 'custom',
                'settings'  => 'title_footer_logo',
                'section'   => $section,
                'default'   => '<h3 class="customize-section-title">' 
                    . __('Logo Rodapé') 
                    . '</h3>'
            )
        );

        Kirki::add_field( 'footer_logo', [
            'type'     => 'image',
            'settings' => 'footer_logo',
            'label'    => esc_html__('Logo Rodapé'),
            'section'  => $section
        ] );
        
    }
}

new Customizer_Options();