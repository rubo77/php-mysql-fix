# php-mysql-fix

A replacement for all mysql functions with mysqli equivalents.

Be aware, that this is just a workaround to fix-up some old code and the resulting project 
will be more vulnerable than if you use the recommended newer mysqli-functions instead.
So only If you are sure that this is not setting your server at risk, you can fix your old
code by adding this line at the beginning of your old code:

### usage

Download and include the file in the top of your PHP script:

    <?php
    include_once('fix_mysql.inc.php');

### discussion

see: https://stackoverflow.com/a/37877644/1069083

If you have any questions open an issue here or enhancements as Pull Request
