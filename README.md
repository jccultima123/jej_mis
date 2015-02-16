# cms-mobilizer

cms-mobilizer is a Simple Content / Information Management System powered by MINI (http://www.php-mini.com)

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

## Installation (in Vagrant, 100% automatic)

If you are using Vagrant for your development, then you can install MINI with one click (or one command on the
command line) [[Vagrant doc](https://docs.vagrantup.com/v2/getting-started/provisioning.html)]. MINI comes with a demo 
Vagrant-file (defines your Vagrant box) and a demo bootstrap.sh which automatically installs Apache, PHP, MySQL, 
PHPMyAdmin, git and Composer, sets a chosen password in MySQL and PHPMyadmin and even inside the application code, 
downloads the Composer-dependencies, activates mod_rewrite and edits the Apache settings, downloads the code from GitHub
and runs the demo SQL statements (for demo data). This is 100% automatic, you'll end up after +/- 5 minutes with a fully 
running installation of MINI2 inside an Ubuntu 14.04 LTS Vagrant box.

To do so, put `Vagrantfile` and `bootstrap.sh` from `_vagrant` inside a folder (and nothing else). 
Do `vagrant box add ubuntu/trusty64` to add Ubuntu 14.04 LTS ("Trusty Thar") 64bit to Vagrant (unless you already have 
it), then do `vagrant up` to run the box. When installation is finished you can directly use the fully installed demo 
app on `192.168.33.44`. As this just a quick demo environment the MySQL root password and the PHPMyAdmin root password 
are set to `12345678`, the project is installed in `/var/www/html/myproject`. You can change this for sure inside
`bootstrap.sh`.

## Auto-Installation on Ubuntu 14.04 LTS (in 30 seconds)

You can install MINI including Apache, MySQL, PHP and PHPMyAdmin, mod_rewrite, Composer, all necessary settings and even the passwords inside the configs file by simply downloading one file and executing it, the entire installation will run 100% automatically. Find the tutorial in this blog article: [Install MINI in 30 seconds inside Ubuntu 14.04 LTS](http://www.dev-metal.com/install-mini-30-seconds-inside-ubuntu-14-04-lts/)

## Installation

1. Edit the database credentials in `application/config/config.php`
2. Execute the .sql statements in the `_install/`-folder (with PHPMyAdmin for example).
3. Make sure you have mod_rewrite activated on your server / in your environment. Some guidelines:
   [Ubuntu 14.04 LTS](http://www.dev-metal.com/enable-mod_rewrite-ubuntu-14-04-lts/),
   [Ubuntu 12.04 LTS](http://www.dev-metal.com/enable-mod_rewrite-ubuntu-12-04-lts/),
   [EasyPHP on Windows](http://stackoverflow.com/questions/8158770/easyphp-and-htaccess),
   [AMPPS on Windows/Mac OS](http://www.softaculous.com/board/index.php?tid=3634&title=AMPPS_rewrite_enable/disable_option%3F_please%3F),
   [XAMPP for Windows](http://www.leonardaustin.com/blog/technical/enable-mod_rewrite-in-xampp/),
   [MAMP on Mac OS](http://stackoverflow.com/questions/7670561/how-to-get-htaccess-to-work-on-mamp)

MINI runs without any further configuration. You can also put it inside a sub-folder, it will work without any 
further configuration.
Maybe useful: A simple tutorial on [How to install LAMPP (Linux, Apache, MySQL, PHP, PHPMyAdmin) on Ubuntu 14.04 LTS](http://www.dev-metal.com/installsetup-basic-lamp-stack-linux-apache-mysql-php-ubuntu-14-04-lts/)
and [the same for Ubuntu 12.04 LTS](http://www.dev-metal.com/setup-basic-lamp-stack-linux-apache-mysql-php-ubuntu-12-04/).

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

## Goodies

MINI comes with a little customized [PDO debugger tool](https://github.com/panique/pdo-debug) (find the code in
application/libs/helper.php), trying to emulate your PDO-SQL statements. It's extremely easy to use:

```php
$sql = "SELECT id, artist, track, link FROM song WHERE id = :song_id LIMIT 1";
$query = $this->db->prepare($sql);
$parameters = array(':song_id' => $song_id);

echo Helper::debugPDO($sql, $parameters);

$query->execute($parameters);
```

## License

This project is licensed under the MIT License.
This means you can use and modify it for free in private or commercial projects.

## Support from  MINI

If you want to support MINI, then rent your next server at
[A2Hosting](https://affiliates.a2hosting.com/idevaffiliate.php?id=4471&url=579) or donate a coffee via
[PayPal](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=P5YLUK4MW3LDG),
[GitTip](https://www.gittip.com/Panique/) or
[Flattr](https://flattr.com/submit/auto?user_id=panique&url=https%3A%2F%2Fgithub.com%2Fpanique%2Fmini).
