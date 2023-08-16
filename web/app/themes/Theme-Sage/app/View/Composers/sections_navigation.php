<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class sections_navigation  extends Composer {
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'sections.navigation',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with() {
        $menu_list_id = get_nav_menu_locations();

        return [
            "logo_url" => $this->get_logo(),
            "home_url" => get_home_url(),
            "menu_un" => $this->get_menu_items($menu_list_id["navigation_menu_un"]),
            "menu_deux" => $this->get_menu_items($menu_list_id["navigation_menu_deux"])
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
        $name = wp_get_nav_menu_object($id)->name;
        $menu = wp_get_nav_menu_object($id);
        $items = wp_get_nav_menu_items($menu->term_id);
        $list_items = [];

        foreach ($items as $item) {
            $list_items[] = [
                "id" => $item->ID,
                "titre" => $item->title,
                "url" => $item->url
            ];
        }
        
        return [
            "titre" => $name,
            "items" => $list_items
        ];
    }
}