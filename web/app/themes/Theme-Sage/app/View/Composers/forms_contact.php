<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class forms_contact  extends Composer {
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'forms.contact',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with() {
        $is_valid = 0;

        if (isset($_POST["FomContact"])) {
            $is_valid = apply_filters("Theme_sage_form_contact", $_POST);
        }

        return [
            "valid" => $is_valid
        ];
    }
}