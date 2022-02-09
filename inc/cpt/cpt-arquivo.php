<?php
/**
 * Register Arquivo Custom Post Type
 * 
 * @package WordPress
 */
    
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class CPT_Arquivo {
    protected $slug;

    /**
     * Construct class
     * 
     * @since 1.0
     */
    public function __construct(string $slug = 'arquivo')
    {
        $this->set_slug($slug);

        $this->register_cpt();
    }

    /**
     * Register custom post type
     *
     * @since 1.0
     */
    public function register_cpt()
    {

        $slug = $this->get_slug();
        $args = $this->get_args();

        register_post_type($slug, $args);
    }

    /**
     * Set slug of custom post type
     *
     * @param string $slug
     * @since 1.0
     */
    protected function set_slug(string $slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug of custom post type
     *
     * @return string
     * @since 1.0
     */
    public function get_slug(): string
    {
        return $this->slug;
    }

    /**
     * Get custom post type *transform* array of arguments
     *
     * @return array
     * @since 1.0
     */
    public function get_args(): array
    {
        $slug = $this->get_slug();

        $labels = array(
            'name'                          => __('Arquivos'),
            'singular_name'                 => __('Arquivo'),
            'menu_name'                     => __('Arquivos'),
            'name_admin_bar'                => __('Arquivo'),
            'add_new'                       => __('Adicionar Novo'),
            'add_new_item'                  => __('Adicionar novo arquivos'),
            'new_item'                      => __('Novo arquivo'),
            'edit_item'                     => __('Editar arquivo'),
            'view_item'                     => __('Ver arquivo'),
            'view_items'                    => __('Ver arquivos'),
            'all_items'                     => __('Todos os arquivos'),
            'search_items'                  => __('Pesquisar arquivo'),
            'parent_items'                  => __('Arquivos superiores'),
            'parent_item_colon'             => __('Arquivos superiores:'),
            'not_found'                     => __('Nenhum arquivo encontrado'),
            'not_found_in_trash'            => __('Nenhum arquivo encontrado na lixeira'),
            'featured_image'                => __('Imagem em destaque'),
            'set_featured_image'            => __('Definir imagem em destaque'),
            'remove_featured_image'         => __('Remover imagem em destaque'),
            'use_featured_image'            => __('Usar como imagem em destaque'),
            'archives'                      => __('Catálogo de arquivos'),
            'insert_into_item'              => __('Inserir em arquivo'),
            'uploaded_to_this_item'         => __('Carregado neste arquivo'),
            'filter_items_list'             => __('Filtrar arquivos'),
            'items_list_navigation'         => __('Navegação por arquivos'),
            'items_list'                    => __('Lista de arquivos'),
            'items_published'               => __('Arquivo publicado'),
            'items_published_protectedly'   => __('Arquivo publicado em privado'),
            'item_reverted_to_draft'        => __('Arquivo revertido a rascunho'),
            'item_updated'                  => __('Arquivo atualizado'),
        );

        $supports = array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'custom-fields',
            'revisions',
            'page-attributes'
        );

        $args = array(
            'label'                 => __('Arquivos'),
            'labels'                => $labels,
            'description'           => __('Arquivos'),
            'public'                => true,
            'show_in_rest'          => true,
            'hierarchical'          => true,
            'menu_position'         => 32,
            'menu_icon'             => 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#f0f6fc99" class="bi bi-archive" viewBox="0 0 16 16">
            <path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
          </svg>'),
            'capability_type'       => 'page',
            'supports'              => $supports,
            'has_archive'           => true,
            'rewrite'               => array('slug' => $slug, 'with_front' => false),
        );

        return $args;
    }
}

new CPT_Arquivo();