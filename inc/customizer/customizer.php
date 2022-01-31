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
         *  Field
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
        

        /**
         * ------------------- Section ----------------
         */
        $section = 'home_options';
        $wp_customize->add_section(
            $section,
            array(
                'title'    => __('Home'),
                'priority' => 20,
                'panel'    => $panel,
            )
        );
       
        /**
         *  Title   
         */
        Kirki::add_field( 
            'title_spe',
            array(
                'type'      => 'custom',
                'settings'  => 'title_spe',
                'section'   => $section,
                'default'   => '<h3 class="customize-section-title">' 
                    . __('SPE') 
                    . '</h3>'
            )
        );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'spe_logo',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'spe_logo', [
            'type'     => 'image',
            'settings' => 'spe_logo',
            'label'    => esc_html__('Logo SPE'),
            'section'  => $section
        ] );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'spe_text',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'spe_text', [
            'type'     => 'textarea',
            'settings' => 'spe_text',
            'label'    => esc_html__('Texto SPE'),
            'section'  => $section
        ] );
        
        

        /**
         * ------------------- Section ----------------
         */
        $section = 'info_options';
        $wp_customize->add_section(
            $section,
            array(
                'title'    => __('Informações'),
                'priority' => 30,
                'panel'    => $panel,
            )
        );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'info_telefone',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'info_telefone', [
            'type'     => 'text',
            'settings' => 'info_telefone',
            'label'    => esc_html__('Telefone'),
            'section'  => $section
        ] );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'info_whatsapp',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'info_whatsapp', [
            'type'     => 'text',
            'settings' => 'info_whatsapp',
            'label'    => esc_html__('WhatsApp'),
            'section'  => $section
        ] );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'info_endereco',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'info_endereco', [
            'type'     => 'editor',
            'settings' => 'info_endereco',
            'label'    => esc_html__('Endereco'),
            'section'  => $section
        ] );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'info_social',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'info_social', [
            'type'        => 'repeater',
            'section'     => $section,
            'settings'     => 'info_social',
            'label'       => esc_html__('Redes Sociais'),
            'row_label' => [
                'type'  => 'field',
                'value' => esc_html__('Ícone'),
                'field' => 'label',
            ],
            'button_label' => esc_html__('Adicionar novo'),
            'default'      => [
                [
                    'icon' => 'facebook',
                    'url'  => 'https://www.facebook.com/',
                ],
                [
                    'icon' => 'instagram',
                    'url'  => 'https://www.instagram.com/',
                ],
            ],
            'fields' => [
                'icon' => [
                    'type' => 'text',
                    'label' => __('Ícone a mostrar'),
                    'description' => __('Utilize os ícones do') . ' Bootstrap Icons',
                ],
                'url'  => [
                    'type' => 'text',
                    'label' => __('Link do ícone'),
                ],
            ]
        ] );
    }
}

new Customizer_Options();