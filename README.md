# Bones / Bootstrap 3 mashup
__A Lightweight Wordpress Development Theme__

Bones is designed to make the life of developers easier. It's built
using HTML5 & has a strong semantic foundation. It was updated recently
using some of the HTML5 Boilerplate's recommended markup and setup.
It's constantly growing so be sure to check back often if you are a
frequent user. I'm always open to contribution. :)

Designed by **Eddie Machado**: http://themble.com/bones

Special Thanks to:
* Paul Irish & the HTML5 Boilerplate
* Yoast for some WP functions & optimization ideas
* Andrew Rogers for code optimization
* David Dellanave for speed & code optimization
* and several other developers. :)

Submit Bugs & or Fixes:
https://github.com/eddiemachado/bones/issues

## Bootstrap 3 additions

I've added the Bootstrap 3 distribution with static nav and sticky footer.  All other default Bones styles have been suspended (including the IE stylesheet), so we're just left with the awesome blank structure in `_base.less` and best practices that bones supplies.

I've stashed the unused files away for reference; I prefer to write my media queries in place using media query bubbling, rather than use separate files for breakpoints which may change.

All my changes are contained in the `bones-bs3` branch.

__Structural changes:__

.footer has become #footer, and the page is no longer wrapped by #container, but rather uses the BS sticky footer structure:

    body
      #wrap
        nav
        .container
          (content)
        #push
      #footer

The bootstrap navigation walker is provided by https://github.com/twittem/wp-bootstrap-navwalker.

This fork also includes other random bits I use along the way (some collected WP debugging functions).

- Bootstrap license: Apache v2.
- BS Nav walker: license: GPL-2.0+.

## License
__[WTFPL](http://sam.zoy.org/wtfpl/)__

	Are You Serious? Yes.


## Meta
* [Changelog](../../blob/master/CHANGELOG.md)
