# Sagextras

A tiny WordPress plugin that restores some Bootstrap specific functionality to the [Sage](https://roots.io/sage) theme. This plugin is modularlized just like Soil, so you only need to load the things you actually need. Add the neccessary lines to your lib/setup.php and the functionality will be there.

## Modules

* **Restore the Roots Bootstrap Navwalker**<br>
  `add_theme_support('se-nav-walker');`

**REMINDER!!!** You need to go into `templates/header.php` and replace the menu code with the code contained in [this Gist](https://gist.github.com/johnny-bit/cc8840f148da01c2af52) so the menu works properly.

~~ * **Bootstrap friendly Gallery code**<br>
  `add_theme_support('se-gallery');`~~ 
**Please Note:** With the release of Sage 8.3.0, this doesn't work anymore because Sage now uses WordPress's standard HTML5 gallery codes.

## Support

Please feel free to open an [issue](https://github.com/storm2k/sagextras/issues) if you run into problems.

## Contributions

I welcome all ideas and support on how to make this better for everyone. [Pull requests](https://github.com/storm2k/sagextras/pulls) are more than welcome. Please take a look at the [contributing](https://github.com/storm2k/sagextras/blob/master/CONTRIBUTING.md) file for coding standards and some testing.

(A big thanks to everyone who has contributed thusfar, especially [johnny-bit](https://github.com/johnny-bit), who has done a lot of work cleaning up the code and bringing it up to par for standards!)

## ToDo

- NavWalker uses code from Sage release 8.1.1. Looking forward to modularizing utils it uses.
- Gallery is now namespaced, looking forward to modularizing any utils it uses.

