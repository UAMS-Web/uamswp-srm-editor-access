<?php

declare(strict_types=1);
/**
 * Plugin Name: UAMSWP Safe Redirect Manager - Editor Access
 * Plugin URI: https://github.com/UAMS-Web/uamswp-srm-editor-access
 * Description: Allows users with the Editor role to access and manage redirects in the UAMSWP Safe Redirect Manager plugin.
 * Version: 1.0.0
 * Requires PHP: 8.2
 * Author: UAMS Web Services
 * Author URI: https://communications.uams.edu/web/
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Copyright: 2026 UAMS Web Services
 */

// Exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}

/**
 * Filter the capability required to manage Safe Redirect Manager.
 * * By default, SRM requires 'manage_options' (Administrators).
 * We change it to 'edit_pages' so that Editors can also manage redirects.
 */
add_filter('uamswp_srm_restrict_to_capability', 'uamswp_srm_allow_editor_access');

function uamswp_srm_allow_editor_access($capability): string
{
    // Return a capability that Editors possess
    return 'edit_pages';
}
