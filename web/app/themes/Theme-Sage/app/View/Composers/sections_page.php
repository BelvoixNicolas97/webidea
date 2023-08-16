<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class sections_page  extends Composer {
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'sections.section_page',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function override() {
        $id_page_section = $this->get_id();

        if (!$id_page_section) {
            return [
                "error" => __("L'id n'a pas été transmise")
            ];
        }else {
            return [
                "id" => $id_page_section,
                "titre" => $this->get_titre($id_page_section),
                "preview" => $this->get_preview(),
                "content" => $this->get_content($id_page_section),
                "link" => $this->get_link($id_page_section),
                "img" => $this->get_img($id_page_section),
                "asset" => $this->is_asset()
            ];
        }
    }

    private function get_id () {
        $error = new \WP_Error();
        $id = $this->data->get("id");

        if (!$id) {
            $error->add("SHORT SAGE_SECTION_PAGE", __("L'id de la page n'a pas été transmise."));

            return false;
        }

        return $id;
    }

    private function get_titre ($id) {
        $titre = get_the_title($id);

        return $titre;
    }

    private function get_preview () {
        $pre = $this->data->get("preview");

        if (!$pre) {
            $pre = "";
        }

        return $pre;
    }

    private function get_content ($id) {
        $post = get_post($id);
        $content = apply_filters("the_content", $post->post_content);
        $content = str_replace(']]>', ']]&gt;', $content);

        return $content;
    }

    private function get_link ($id) {
        $link = get_permalink($id);

        return $link;
    }

    private function get_img ($id) {
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

    private function is_asset () {
        $asset = $this->data->get("asset");

        if ($asset > 0) {
            return true;
        }else {
            return false;
        }
    }
}