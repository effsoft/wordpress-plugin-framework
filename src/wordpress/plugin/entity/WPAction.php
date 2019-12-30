<?php

namespace wordpress\plugin\entity;

use MabeEnum\Enum;

class WPAction extends Enum{

    const ADMIN_MENU = 'admin_menu';
    const ADMIN_NOTICE = 'admin_notices';

    const ADMIN_ENQUEUE_SCRIPTS = 'admin_enqueue_scripts';
    const LOGIN_ENQUEUE_SCRIPTS = 'login_enqueue_scripts';
    const WP_ENQUEUE_SCRIPTS = 'wp_enqueue_scripts';

    const REST_API_INIT = 'rest_api_init';
}