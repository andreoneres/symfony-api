Symfony Application
========================
Requirements
------------

  * PHP 8.0.2 or higher;
  * PDO-mySQL PHP extension enabled;
  * and the [usual Symfony application requirements][2].

Installation
------------

To download and install the project on your computer, run
these commands:

Clone the project to download its contents
```bash
$ cd projects/
$ git clone https://github.com/andreoneres/symfony-api.git
```

Make composer install the project's dependencies into vendor:
```bash
$ cd symfony-api/
$ composer install
```

Usage
-----

There's no need to configure anything to run the application. If you have
[installed Symfony][4] binary, run this command:

```bash
$ cd symfony-api/
$ symfony server:start
```

Then access the application in your browser at the given URL (<https://localhost:8000> by default).

If you don't have the Symfony binary installed, run `php -S localhost:8000 -t public/`
to use the built-in PHP web server or [configure a web server][3] like Nginx or Apache to run the application.

Tests
-----

Execute this command to run tests:

```bash
$ cd symfony-api/
$ ./bin/phpunit
```

[1]: https://symfony.com/doc/current/best_practices.html
[2]: https://symfony.com/doc/current/setup.html#technical-requirements
[3]: https://symfony.com/doc/current/setup/web_server_configuration.html
[4]: https://symfony.com/download
[5]: https://symfony.com/book