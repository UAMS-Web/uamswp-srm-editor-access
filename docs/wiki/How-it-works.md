Written against v1.1.1.

The plugin changes one thing: the capability that UAMSWP Safe Redirect Manager requires before a user can manage redirects. It has no settings screen and stores nothing.

## The filter

UAMSWP Safe Redirect Manager asks the `uamswp_srm_restrict_to_capability` filter which capability a user must have to manage redirects. Its own default is `uamswp_srm_manage_redirects`, a capability it grants to the Administrator role.

This plugin adds a callback to that filter, `uamswp_srm_allow_editor_access()`, which always returns `edit_pages`. The callback ignores the value it is given, so it replaces the default rather than adding to it.

| Item | Value |
| --- | --- |
| Filter | `uamswp_srm_restrict_to_capability` |
| Callback | `uamswp_srm_allow_editor_access()` |
| Priority | `10` (the default) |
| Returns | `edit_pages` |
| Default it replaces | `uamswp_srm_manage_redirects` |

## Who gains access

Any user whose role has `edit_pages` can manage redirects while this plugin is active. In a default WordPress install:

| Role | Has `edit_pages` | Manages redirects |
| --- | --- | --- |
| Administrator | yes | yes |
| Editor | yes | yes |
| Author | no | no |
| Contributor | no | no |
| Subscriber | no | no |

**Note:** a custom role, or a role changed by another plugin, follows the same rule: it manages redirects exactly when it has `edit_pages`.

## Turning it off

Deactivate the plugin. Safe Redirect Manager then goes back to requiring `uamswp_srm_manage_redirects`, which by default only the Administrator role has.

## Reference

- [Troubleshooting](Troubleshooting.md)
- [Requirements and installation (README)](https://github.com/UAMS-Web/uamswp-srm-editor-access#requirements)
