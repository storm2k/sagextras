# Sagextras

A tiny WordPress plugin that restores some Bootstrap specific functionality to the [Sage](https://roots.io/sage) theme. This plugin is modularlized just like Soil, so you only need to load the things you actually need. Add the neccessary lines to your lib/config.php and the functionality will be there.

## Modules

* **Restore the Roots Bootstrap Navwalker**<br>
  `add_theme_support('se-navwalker');`

**REMINDER!!!** You need to go into `templates/header.php` and replace the menu code with the code contained in [this Gist](https://gist.github.com/storm2k/c7ca7f93ed155f5a8f85) so the menu works properly.

* **Bootstrap friendly Gallery code**<br>
  `add_theme_support('se-gallery');`

## Support

Please feel free to open an issue if you run into problems.

## Contributions

I welcome all ideas and support on how to make this better for everyone. Pull requests are more than welcome.

## ToDo

Look into using the code from the 8.0 or 8.1 releases of Sage for the navwalker. This is currently using the 7.0.3 version, and it can be a little flaky.