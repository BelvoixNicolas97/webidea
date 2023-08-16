<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class sections_list_articles  extends Composer {
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'sections.list-articles',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with() {
        return [
            "articles" => $this->get_list_articles()
        ];
    }

    private function get_list_articles () {
        $args = [
            "numberposts" => -1,
        ];
        $result = [];
        $query = get_posts($args);

        foreach ($query as $key => $value){
            if (strlen($value->post_password) === 0 && $value->post_status === "publish") {
                $result[] = $this->get_article($value->ID);
            }
        }

        return $result;
    }

    private function get_article ($id) {
        $titre = get_the_title($id);
        $link = get_permalink($id);
        $img_id = get_post_thumbnail_id($id);
        if ($img_id < 1) {
            $img_url = false;
            $img_alt = false;
        }else {
            $img_url = wp_get_attachment_image_src($img_id , 'full' )[0];
            $img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true );
        }
        $result = [
            "id" => $id,
            "titre" => $titre,
            "img" => [
                "url" => $img_url,
                "alt" => $img_alt
            ],
            "link" => $link
        ];

        return $result;
    }
}