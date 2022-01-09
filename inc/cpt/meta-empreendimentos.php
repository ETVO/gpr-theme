<?php

/**
 * Create CPT Meta Fields
 * 
 * @package WordPress
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

define('EMPRE_META_NONCE', 'empreendimentos_metabox_nonce');

/**
 * Setup Meta Box for CPT
 */
class Meta_Empreendimentos
{

    /**
     * Hook into the appropriate actions when the class is constructed.
     */
    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'add_metabox'));
        add_action('save_post',      array($this, 'save'));
    }

    /**
     * Adds the meta box container.
     */
    public function add_metabox($post_type)
    {
        // Limit meta box to certain post types.
        $allowed_post_type = 'empreendimento';

        $box_label = __('Características em Destaque');
        $metabox_name = 'empreendimento-destaque';

        if ($post_type == $allowed_post_type) {
            add_meta_box(
                $metabox_name,
                $box_label,
                array($this, 'render_metabox_content'),
                $post_type,
                'advanced',
                'high'
            );
        }
    }

    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_metabox_content(WP_Post $post)
    {

        // Add an nonce field so we can check for it later.
        wp_nonce_field(EMPRE_META_NONCE, EMPRE_META_NONCE);

        $gpminvoice_group = get_post_meta($post->ID, 'customdata_group', true);
?>

        <div class="repeater-field acf-field" id="repeaterDestaques">
            <div class="title">
                <label for="repeaterDestaques">Características em Destaque</label>
            </div>
            <div class="rows">
                <div class="empty-row row">
                    <div class="fields">
                        <div class="field icon-field">
                            <label for="">Ícone</label>
                            <img src="" class="image-preview" />
                            <input type="hidden" name="icon_carac[]" value="" class="image-input">
                            <span class="icon-btn select-image-button" title="Selecionar imagem">
                                <span class="bi bi-image"></span>
                            </span>
                            <span class="icon-btn text-danger remove-image-button" title="Remover imagem">
                                <span class="bi bi-x-circle"></span>
                            </span>
                        </div>

                        <div class="field text-field flex-fill">
                            <label for="">Descrição</label>
                            <input type="text" placeholder="Descrição da Característica" name="desc_carac[]" id="">
                        </div>
                    </div>
                    <div class="action">
                        <button class="remove-row button is-destructive" type="button">Remover</button>
                    </div>
                </div>
            </div>
            <div class="bottom-action">
                <button class="add-row button" type="button" data-parent="#repeaterDestaques">Adicionar nova</button>
            </div>
        </div>
<?php
    }
    /**
     * Save the meta when the post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     * @since 1.0
     */
    public function save(int $post_id)
    {

        $post_type = 'empreendimento';

        /*
         * We need to verify this came from the our screen and with proper authorization,
         * because save_post can be triggered at other times.
         */

        // Check if our nonce is set.
        if (!isset($_POST[EMPRE_META_NONCE])) {
            return $post_id;
        }

        $nonce = $_POST[EMPRE_META_NONCE];

        // Verify that the nonce is valid.
        if (!wp_verify_nonce($nonce, EMPRE_META_NONCE)) {
            return $post_id;
        }

        /*
         * If this is an autosave, our form has not been submitted,
         * so we don't want to do anything.
         */
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        // Check the user's permissions.
        if (isset($_POST['post_type']) && $_POST['post_type'] == $post_type) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } else {
            if (!current_user_can('edit_post', $post_id)) {
                return $post_id;
            }
        }

        /* OK, now it's safe for us to save the data. */

        $old = get_post_meta($post_id, 'customdata_group', true);
        $new = array();
        $invoiceItems = $_POST['TitleItem'];
        $prices = $_POST['TitleDescription'];
        $count = count($invoiceItems);
        for ($i = 0; $i < $count; $i++) {
            if ($invoiceItems[$i] != '') {
                $new[$i]['TitleItem'] = stripslashes(strip_tags($invoiceItems[$i]));
                $new[$i]['TitleDescription'] = stripslashes($prices[$i]); // and however you want to sanitize
            }
        }

        if (!empty($new) && $new != $old) {
            update_post_meta($post_id, 'customdata_group', $new);
        } else if (empty($new) && $old) {
            delete_post_meta($post_id, 'customdata_group', $old);
        }
    }
}

new Meta_Empreendimentos();
