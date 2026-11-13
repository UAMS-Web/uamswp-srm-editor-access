# UAMSWP Safe Redirect Manager - Editor Access

Allows users with the Editor role to access and manage redirects in the UAMSWP Safe Redirect Manager plugin.

## Running the tests

The suite is Pest 5 with Brain Monkey: WordPress functions are mocked, so it needs no database and no WordPress checkout. It develops on PHP 8.4.27 (`config.platform.php` in `composer.json`).

```bash
composer install
vendor/bin/pest
```

`composer test` runs the same suite. Tests live in `tests/Unit/`.
