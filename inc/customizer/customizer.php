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
                'title'    => 'Home',
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
            'type'     => 'editor',
            'settings' => 'spe_text',
            'label'    => esc_html__('Texto SPE'),
            'section'  => $section
        ] );
       
        /**
         *  Title   
         */
        Kirki::add_field( 
            'title_form',
            array(
                'type'      => 'custom',
                'settings'  => 'title_form',
                'section'   => $section,
                'default'   => '<h3 class="customize-section-title">' 
                    . __('Formulário') 
                    . '</h3>'
            )
        );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'form_image',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'form_image', [
            'type'     => 'image',
            'settings' => 'form_image',
            'label'    => esc_html__('Imagem de fundo'),
            'section'  => $section
        ] );
        

        /**
         * ------------------- Section ----------------
         */
        $section = 'aboutus_options';
        $wp_customize->add_section(
            $section,
            array(
                'title'    => __('Quem Somos'),
                'priority' => 25,
                'panel'    => $panel,
            )
        );
       
        /**
         *  Title   
         */
        Kirki::add_field( 
            'aboutus_banner',
            array(
                'type'      => 'custom',
                'settings'  => 'aboutus_banner',
                'section'   => $section,
                'default'   => '<h3 class="customize-section-title">' 
                    . __('Banner') 
                    . '</h3>'
            )
        );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'banner_image',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'banner_image', [
            'type'     => 'image',
            'settings' => 'banner_image',
            'label'    => esc_html__('Imagem de fundo'),
            'section'  => $section
        ] );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'banner_text',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'banner_text', [
            'type'     => 'text',
            'settings' => 'banner_text',
            'label'    => esc_html__('Texto'),
            'section'  => $section
        ] );
        
       
        /**
         *  Title   
         */
        Kirki::add_field( 
            'aboutus_dna',
            array(
                'type'      => 'custom',
                'settings'  => 'aboutus_dna',
                'section'   => $section,
                'default'   => '<h3 class="customize-section-title">' 
                    . __('DNA') 
                    . '</h3>'
            )
        );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'dna_image',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'dna_image', [
            'type'     => 'image',
            'settings' => 'dna_image',
            'label'    => esc_html__('Imagem de fundo'),
            'section'  => $section
        ] );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'dna_title',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'dna_title', [
            'type'     => 'text',
            'settings' => 'dna_title',
            'label'    => esc_html__('Título'),
            'section'  => $section
        ] );
        

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'dna_text',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'dna_text', [
            'type'     => 'editor',
            'settings' => 'dna_text',
            'label'    => esc_html__('Texto'),
            'section'  => $section
        ] );
        
        
       
        /**
         *  Title   
         */
        Kirki::add_field( 
            'aboutus_parceiros',
            array(
                'type'      => 'custom',
                'settings'  => 'aboutus_parceiros',
                'section'   => $section,
                'default'   => '<h3 class="customize-section-title">' 
                    . __('Parceiros') 
                    . '</h3>'
            )
        );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'parceiros_image',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'parceiros_image', [
            'type'     => 'image',
            'settings' => 'parceiros_image',
            'label'    => esc_html__('Imagem de fundo'),
            'section'  => $section
        ] );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'parceiros_title',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'parceiros_title', [
            'type'     => 'text',
            'settings' => 'parceiros_title',
            'label'    => esc_html__('Título'),
            'section'  => $section
        ] );
       


        /**
         *  Title   
         */
        Kirki::add_field( 
            'aboutus_servicos',
            array(
                'type'      => 'custom',
                'settings'  => 'aboutus_servicos',
                'section'   => $section,
                'default'   => '<h3 class="customize-section-title">' 
                    . __('Serviços') 
                    . '</h3>'
            )
        );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'servicos',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'servicos', [
            'type'        => 'repeater',
            'section'     => $section,
            'settings'     => 'servicos',
            'label'       => esc_html__('Serviços prestados'),
            'row_label' => [
                'type'  => 'field',
                'value' => esc_html__('Serviço'),
                'field' => 'label',
            ],
            'button_label' => esc_html__('Adicionar novo'),
            'default'      => [
                [
                    'desc' => 'Estudo de Viabilidade econômico e financeira',
                ],
            ],
            'fields' => [
                'desc'  => [
                    'type' => 'text',
                    'label' => __('Descrição do serviço'),
                ],
            ]
        ] );
       


        /**
         *  Title   
         */
        Kirki::add_field( 
            'aboutus_cultura',
            array(
                'type'      => 'custom',
                'settings'  => 'aboutus_cultura',
                'section'   => $section,
                'default'   => '<h3 class="customize-section-title">' 
                    . __('Cultura GPR') 
                    . '</h3>'
            )
        );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'cultura_title',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'cultura_title', [
            'type'     => 'text',
            'settings' => 'cultura_title',
            'label'    => esc_html__('Título'),
            'section'  => $section
        ] );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'cultura_backimg',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'cultura_backimg', [
            'type'     => 'image',
            'settings' => 'cultura_backimg',
            'label'    => esc_html__('Imagem de fundo'),
            'section'  => $section
        ] );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'cultura_sideimg',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'cultura_sideimg', [
            'type'     => 'image',
            'settings' => 'cultura_sideimg',
            'label'    => esc_html__('Imagem lateral'),
            'section'  => $section
        ] );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'cultura_valores',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'cultura_valores', [
            'type'        => 'repeater',
            'section'     => $section,
            'settings'     => 'cultura_valores',
            'label'       => esc_html__('Valores'),
            'row_label' => [
                'type'  => 'field',
                'value' => esc_html__('Valor'),
                'field' => 'label',
            ],
            'button_label' => esc_html__('Adicionar novo'),
            'default'      => [],
            'fields' => [
                'image'  => [
                    'type' => 'image',
                    'label' => __('Ícone'),
                ],
                'title'  => [
                    'type' => 'text',
                    'label' => __('Título'),
                ],
                'desc'  => [
                    'type' => 'textarea',
                    'label' => __('Descrição'),
                ],
            ]
        ] );
        

        /**
         * ------------------- Section ----------------
         */
        $section = 'negocio_options';
        $wp_customize->add_section(
            $section,
            array(
                'title'    => __('O Negócio'),
                'priority' => 27,
                'panel'    => $panel,
            )
        );
       
        /**
         *  Title   
         */
        Kirki::add_field( 
            'negocio_spe',
            array(
                'type'      => 'custom',
                'settings'  => 'negocio_spe',
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
            'spe_long_image',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'spe_long_image', [
            'type'     => 'image',
            'settings' => 'spe_long_image',
            'label'    => esc_html__('Imagem de fundo'),
            'section'  => $section
        ] );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'spe_long_text',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'spe_long_text', [
            'type'     => 'editor',
            'settings' => 'spe_long_text',
            'label'    => esc_html__('Texto'),
            'section'  => $section
        ] );
        
        /**
         *  Title   
         */
        Kirki::add_field( 
            'negocio_projeto',
            array(
                'type'      => 'custom',
                'settings'  => 'negocio_projeto',
                'section'   => $section,
                'default'   => '<h3 class="customize-section-title">' 
                    . __('Etapas dos projetos') 
                    . '</h3>'
            )
        );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'projeto_timeline',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'projeto_timeline', [
            'type'     => 'image',
            'settings' => 'projeto_timeline',
            'label'    => esc_html__('Linha do tempo'),
            'section'  => $section
        ] );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'projeto_etapas',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'projeto_etapas', [
            'type'        => 'repeater',
            'section'     => $section,
            'settings'     => 'projeto_etapas',
            'label'       => esc_html__('Etapas'),
            'row_label' => [
                'type'  => 'field',
                'value' => esc_html__('Etapa'),
                'field' => 'label',
            ],
            'button_label' => esc_html__('Adicionar novo'),
            'default'      => [],
            'fields' => [
                'title'  => [
                    'type' => 'text',
                    'label' => __('Título'),
                ],
                'icon' => [
                    'type' => 'image',
                    'label' => __('Ícone')
                ],
                'desc'  => [
                    'type' => 'textarea',
                    'label' => __('Descrição'),
                ],
            ]
        ] );
        
        /**
         *  Title   
         */
        Kirki::add_field( 
            'negocio_acompanhamento',
            array(
                'type'      => 'custom',
                'settings'  => 'negocio_acompanhamento',
                'section'   => $section,
                'default'   => '<h3 class="customize-section-title">' 
                    . __('Acompanhamento') 
                    . '</h3>'
            )
        );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'acompanhamento_text',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'acompanhamento_text', [
            'type'     => 'editor',
            'settings' => 'acompanhamento_text',
            'label'    => esc_html__('Texto'),
            'section'  => $section
        ] );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'acompanhamento_link',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'acompanhamento_link', [
            'type'     => 'url',
            'settings' => 'acompanhamento_link',
            'label'    => esc_html__('Link'),
            'section'  => $section
        ] );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'acompanhamento_image',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'acompanhamento_image', [
            'type'     => 'image',
            'settings' => 'acompanhamento_image',
            'label'    => esc_html__('Imagem'),
            'section'  => $section
        ] );

        /**
         * ------------------- Section ----------------
         */
        $section = 'empre_options';
        $wp_customize->add_section(
            $section,
            array(
                'title'    => __('Empreendimentos'),
                'priority' => 28,
                'panel'    => $panel,
            )
        );
        
        
        /**
         *  Title   
         */
        Kirki::add_field( 
            'empre_cta_acesso',
            array(
                'type'      => 'custom',
                'settings'  => 'empre_cta_acesso',
                'section'   => $section,
                'default'   => '<h3 class="customize-section-title">' 
                    . __('CTA Acesso Investidor') 
                    . '</h3>'
            )
        );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'acesso_text',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'acesso_text', [
            'type'     => 'editor',
            'settings' => 'acesso_text',
            'label'    => esc_html__('Texto'),
            'section'  => $section
        ] );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'acesso_link',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'acesso_link', [
            'type'     => 'url',
            'settings' => 'acesso_link',
            'label'    => esc_html__('Link'),
            'section'  => $section
        ] );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'acesso_image',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'acesso_image', [
            'type'     => 'image',
            'settings' => 'acesso_image',
            'label'    => esc_html__('Imagem'),
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
        /**
         * ------------------- Section ----------------
         */
        $section = 'contato_options';
        $wp_customize->add_section(
            $section,
            array(
                'title'    => __('Contato (página)'),
                'priority' => 31,
                'panel'    => $panel,
            )
        );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'contato_address',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'contato_address', [
            'type'     => 'editor',
            'settings' => 'contato_address',
            'label'    => esc_html__('Endereço'),
            'section'  => $section
        ] );

        /**
         *  Field
         */
        $wp_customize->add_setting(
            'contato_map_logo',
            array(
                'default' => ''
            )
        );

        Kirki::add_field( 'contato_map_logo', [
            'type'          => 'image',
            'settings'      => 'contato_map_logo',
            'label'         => esc_html__('Logo'),
            'description'   => esc_html__('A ser exibida na seção "como chegar"'),
            'section'       => $section
        ] );
    }
}

new Customizer_Options();