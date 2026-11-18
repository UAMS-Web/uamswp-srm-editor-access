# UAMSWP Safe Redirect Manager - Editor Access

Allows users with the Editor role to access and manage redirects in the UAMSWP Safe Redirect Manager plugin.

How it works and what to check when Editors do not get access: see the [wiki](https://github.com/UAMS-Web/uamswp-srm-editor-access/wiki).

## Requirements

- WordPress 6.8 or later
- PHP 8.2 or later
- The UAMSWP Safe Redirect Manager plugin, active

## Installation

1. Place this plugin's folder in `wp-content/plugins/`.
2. In **Plugins**, activate **UAMSWP Safe Redirect Manager - Editor Access**.

Editors can then manage redirects. There is nothing to configure.

## Running the tests

The suite is Pest 5 with Brain Monkey: WordPress functions are mocked, so it needs no database and no WordPress checkout. It develops on PHP 8.4.27 (`config.platform.php` in `composer.json`).

```bash
composer install
vendor/bin/pest
```

`composer test` runs the same suite. Tests live in `tests/Unit/`.

## Credits

Developed and maintained by UAMS Web Services.

Developers:

- Josh Daugherty
- Todd McKee

## License

Copyright 2026 UAMS Web Services. Released under the GNU General Public License, version 2 or later (GPL-2.0-or-later). The full text of version 2 is in [`LICENSE`](LICENSE).
