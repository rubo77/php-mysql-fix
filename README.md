# php-mysql-fix

A replacement for all mysql functions with mysqli equivalents.

Be aware, that this is just a workaround to fix-up some old code and the resulting project 
will be more vulnerable than if you use the recommended newer mysqli-functions instead.
So only If you are sure that this is not setting your server at risk, you can fix your old
code by adding this replacement.

### usage

You can install it via Composer adding this to your `composer.json`:

```json
{
    "name": "<vendor>/<project>",
    "repositories" : [
        {
            "type": "vcs",
            "url": "https://github.com/rubo77/php-mysql-fix"
        }
    ],
    "require": {
        "rubo77/php-mysql-fix": "^4.0"
    },
    "autoload": {
        "files": [
            "vendor/rubo77/php-mysql-fix/fix_mysql.inc.php"
        ]
    }
}

```

and then typing:

```sh
$ composer update
```

Alternatively you can manually download and include the file at the top of your PHP script:

```php
<?php
require 'fix_mysql.inc.php';
```

### discussion

see: https://stackoverflow.com/a/37877644/1069083

If you have any questions open an issue here or enhancements as Pull Request
