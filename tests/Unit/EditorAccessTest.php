<?php

/**
 * The editor-access filter, with WordPress mocked.
 *
 * @see uamswp-srm-editor-access.php
 */

declare(strict_types=1);

use function Brain\Monkey\Filters\expectAdded;
use Brain\Monkey\Filters;

it('registers the capability filter and grants the Editor capability', function (): void {
    // The plugin registers its filter at file scope, so loading it inside the
    // test is what lets Brain Monkey observe the registration.
    expectAdded('uamswp_srm_restrict_to_capability')
        ->once()
        ->with('uamswp_srm_allow_editor_access');

    require_once dirname(__DIR__, 2).'/uamswp-srm-editor-access.php';

    expect(uamswp_srm_allow_editor_access('manage_options'))->toBe('edit_pages');
});
