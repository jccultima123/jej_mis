# jej_ims (jccultimaCMS)

jccultimaCMS is a Simple Content / Information Management System powered by MINI (http://www.php-mini.com)

## Features

- extremely simple, easy to understand
- simple but clean structure
- makes "beautiful" clean URLs
- demo CRUD actions: Create, Read, Update and Delete database entries easily
- tries to follow PSR 1/2 coding guidelines
- uses PDO for any database requests, comes with an additional PDO debug tool to emulate your SQL statements
- commented code
- uses only native PHP code, so people don't have to learn a framework

## Requirements

- PHP 5.3.0+
- MySQL
- mod_rewrite activated (tutorials below, but there's also [TINY](https://github.com/panique/tiny), a mod_rewrite-less 
version of MINI)

## Documentation

A very early documentation can be found on [php-mini.com/documentation](http://php-mini.com/documentation/).

## Server configs for

### nginx

TODO (please commit if you have a perfect config)

### IIS

TODO (please commit if you have a perfect config)

## Security

The script makes use of mod_rewrite and blocks all access to everything outside the /public folder.
Your .git folder/files, operating system temp files, the application-folder and everything else is not accessible
(when set up correctly). For database requests PDO is used, so no need to think about SQL injection (unless you
are using extremely outdated MySQL versions).

## License

This project is licensed under the MIT License.
This means you can use and modify it for free in private or commercial projects.

## Support from  MINI

If you want to support MINI, then rent your next server at
[A2Hosting](https://affiliates.a2hosting.com/idevaffiliate.php?id=4471&url=579) or donate a coffee via
[PayPal](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=P5YLUK4MW3LDG),
[GitTip](https://www.gittip.com/Panique/) or
[Flattr](https://flattr.com/submit/auto?user_id=panique&url=https%3A%2F%2Fgithub.com%2Fpanique%2Fmini).
