Written against v1.1.1.

- [An Editor does not see the redirects screen](#an-editor-does-not-see-the-redirects-screen)
- [An Author or Contributor cannot manage redirects](#an-author-or-contributor-cannot-manage-redirects)
- [The Redirect to field suggests no posts or pages for an Editor](#the-redirect-to-field-suggests-no-posts-or-pages-for-an-editor)

## An Editor does not see the redirects screen

**Cause:** UAMSWP Safe Redirect Manager is not active, or this plugin is not active, or the user's role does not have `edit_pages`. This plugin only changes the capability that Safe Redirect Manager asks for; without Safe Redirect Manager there is nothing to change.

**Fix:** in **Plugins**, confirm that both UAMSWP Safe Redirect Manager and this plugin are active. Then confirm that the user's role has `edit_pages`: a role edited by another plugin may have lost it. See [How it works](How-it-works.md#who-gains-access).

## An Author or Contributor cannot manage redirects

**Cause:** this is the intended behavior. Authors and Contributors do not have `edit_pages`, so this plugin does not give them access.

**Fix:** if one of them needs to manage redirects, give their account the Editor role, or give their role `edit_pages` (which also lets them edit pages).

## The Redirect to field suggests no posts or pages for an Editor

**Cause:** read from the UAMSWP Safe Redirect Manager source, not reproduced on a site: the request that fills the **Redirect to** suggestions checks for `uamswp_srm_manage_redirects` directly instead of the filtered capability, so this plugin does not reach it. An Editor gets an empty list where an Administrator gets suggestions.

**Fix:** type the destination URL in full instead of picking it from the suggestions.

## Reference

- [How it works](How-it-works.md)
