<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class layouts_page  extends Composer {
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'layouts.page',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with() {
        $content_id = get_the_ID();

        return [
            "id" => $content_id,
            "content" => $this->get_content($content_id)
        ];
    }

    private function get_content($id) {
        $post = get_post($id);
        $content = apply_filters("the_content", $post->post_content);
        $content = str_replace(']]>', ']]&gt;', $content);

        return $content;
    }
}