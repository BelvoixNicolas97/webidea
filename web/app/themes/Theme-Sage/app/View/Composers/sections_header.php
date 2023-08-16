<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class sections_header  extends Composer {
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'sections.header',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with() {
        $content_id = get_the_ID();

        return [
            "titre" => $this->get_titre($content_id),
            "img_header" => $this->get_img($content_id),
            "extrait" => $this->get_extrait($content_id)
        ];
    }

    private function get_titre ($id) {
        $titre = get_the_title($id);

        $titre = str_replace("{", "<span>", $titre);
        $titre = str_replace("}", "</span>", $titre);


        return $titre;
    }

    private function get_img($id) {
        $img_id = get_post_thumbnail_id($id);

        if (!$img_id) {
            return false;
        }else {
            $img_url = wp_get_attachment_image_src($img_id , 'full' )[0];
            $img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true );
        }

        return [
            "url" => $img_url,
            "alt" => $img_alt
        ];
    }

    private function get_extrait ($id) {
        $extrait = get_post_meta($id,'post_extrait',true);

        if (!is_string($extrait)) {
            $extrait = "";
        }

        return $extrait;
    }
}