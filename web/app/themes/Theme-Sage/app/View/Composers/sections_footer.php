<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class sections_footer  extends Composer {
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'sections.footer',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with() {
        $menu_list_id = get_nav_menu_locations();
        $logo = $this->get_logo();
        $menu_un = (isset($menu_list_id["footer_menu_un"]))? $this->get_menu_items($menu_list_id["footer_menu_un"]) : [];
        $menu_deux = (isset($menu_list_id["footer_menu_deux"]))? $this->get_menu_items($menu_list_id["footer_menu_deux"]) : [];
        $menu_reseaux = (isset($menu_list_id["menu_reseaux"]))? $this->get_menu_items($menu_list_id["menu_reseaux"]) : [];

        return [
            "logo_url" => $logo,
            "menu_1" => $menu_un,
            "menu_2" => $menu_deux,
            "menu_reseaux" => $menu_reseaux
        ];
    }

    private function get_logo () {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $custom_logo_url = wp_get_attachment_image_src( $custom_logo_id , 'full' )[0];
        $custom_logo_alt = get_post_meta($custom_logo_id, '_wp_attachment_image_alt', true);

        return [
            "url" => $custom_logo_url,
            "alt" => $custom_logo_alt
        ];
    }

    private function get_menu_items ($id) {
        $menu = wp_get_nav_menu_object($id);
        $items;
        $list_items = [];
        
        if (!$menu) {
            return $list_items;
        }else {
            $items = wp_get_nav_menu_items($menu->term_id);
        }

        foreach ($items as $item) {
            $list_items[] = [
                "id" => $item->ID,
                "titre" => $item->title,
                "url" => $item->url
            ];
        }
        
        return $list_items;
    }
}