# Block Page Layout

Registers a display variant for Page Manager that works just like "Block Page" but uses Layout Plugins.

Installation
------------

Add this to your `composer.json`:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/caxy/blockpagelayout-module.git"
        }
    ],
    "require-dev": {
        "caxy/blockpagelayout-module": "dev-master"
    }
}
```

Then run `drush en blockpagelayout`. This will enable the dependencies as well. To begin making pages, run `drush en page_manager_ui`.

This module conflicts with Layout Plugin's module named `block_page_layout` which is [apparently not going to be maintained](https://www.drupal.org/node/2680351) and has fatal errors in current releases of Drupal 8.

Features
--------

* Unlike the original module this module is based on, this module uses Drupal core's `region.html.twig` (and suggestions based on the region name) theme instead of using element `#prefix` and `#suffix` to wrap regions.
* This module supplies a default layout that allows it to be useful without any additional layout plugins.
