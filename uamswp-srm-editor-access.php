<?php

declare(strict_types=1);
/**
 * Plugin Name: UAMSWP Safe Redirect Manager - Editor Access
 * Plugin URI: https://github.com/UAMS-Web/uamswp-srm-editor-access
 * Description: Allows users with the Editor role to access and manage redirects in the UAMSWP Safe Redirect Manager plugin.
 * Version: 1.1.0
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

/**
 * Return the capability that lets Editors manage redirects.
 *
 * WordPress passes the capability being filtered, and the answer does not depend on it, so the
 * callback declares no parameter: PHP drops the extra argument at runtime.
 */
function uamswp_srm_allow_editor_access(): string
{
    // Return a capability that Editors possess
    return 'edit_pages';
}
