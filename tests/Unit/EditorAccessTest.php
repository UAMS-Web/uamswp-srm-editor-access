<?php

/**
 * The editor-access filter, with WordPress mocked.
 *
 * The population is the single file `uamswp-srm-editor-access.php`, mutated with
 * `pest --mutate --everything --path=uamswp-srm-editor-access.php` because the file holds
 * functions and no class for `covers()` to name. The direct-access guard's `exit`
 * cannot run inside the suite's own process, so a child PHP process pins it.
 *
 * @see uamswp-srm-editor-access.php
 */

declare(strict_types=1);

use function Brain\Monkey\Filters\expectAdded;

const PLUGIN_FILE = __DIR__.'/../../uamswp-srm-editor-access.php';

/**
 * Load the plugin file in a fresh PHP process and report what it did.
 *
 * `add_filter` is replaced by a function that prints a marker, and a second marker
 * prints after the file returns, so the output says whether the guard stopped the
 * file and whether the registration ran.
 *
 * @return array{string, int} The child's standard output and exit status.
 */
function runPluginFile(bool $withAbspath): array
{
    $script = ($withAbspath ? "define('ABSPATH', '/tmp/');" : '')
        .'function add_filter(string $hook, string $callback): void { echo "ADD:$hook:$callback;"; }'
        .'require '.var_export(PLUGIN_FILE, true).';'
        .'echo "AFTER;";';

    exec(escapeshellarg(PHP_BINARY).' -r '.escapeshellarg($script).' 2>&1', $lines, $status);

    return [implode("\n", $lines), $status];
}

it('registers the capability filter', function (): void {
    // The plugin registers its filter at file scope, so loading it inside the
    // test is what lets Brain Monkey observe the registration.
    expectAdded('uamswp_srm_restrict_to_capability')
        ->once()
        ->with('uamswp_srm_allow_editor_access');

    require_once PLUGIN_FILE;
});

it('grants the Editor capability', function (): void {
    require_once PLUGIN_FILE;

    expect(uamswp_srm_allow_editor_access())->toBe('edit_pages');
});

it('grants the Editor capability whatever capability WordPress passes it', function (array $arguments): void {
    require_once PLUGIN_FILE;

    // WordPress calls the callback with the capability being filtered.
    expect(call_user_func_array('uamswp_srm_allow_editor_access', $arguments))->toBe('edit_pages');
})->with([[['manage_options']], [['edit_pages']], [['read']], [['']]]);

it('registers the filter and runs on to the end when WordPress defines ABSPATH', function (): void {
    [$output, $status] = runPluginFile(true);

    expect($status)->toBe(0)
        ->and($output)->toBe('ADD:uamswp_srm_restrict_to_capability:uamswp_srm_allow_editor_access;AFTER;');
});

it('exits at once, registering nothing, when the file is reached directly', function (): void {
    [$output, $status] = runPluginFile(false);

    expect($status)->toBe(0)
        ->and($output)->toBe('');
});
