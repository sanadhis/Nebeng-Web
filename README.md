Nebeng - Web Application
============================

Nebeng is vehicle sharing plaform at Universitas Indonesia. The project is one of the sub-research of UI's green transportation system. To use this application, users have to log in using UI's credentials (username & password) by SSO.

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      dbdata              contains db backup
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

- The minimum requirement by this project template that your Web server supports PHP 5.4.0.
- Require MySQL Database
- Require LDAP-enabled support
- Require Mod-Rewrite


INSTALLATION
------------

### Install from an Archive File

1. Download or pull this repository
2. Make sure you are in the master/development branch
3. Put the archieve in your web server directory (e.g. /var/www/ , /xampp/htdocs/, /lampp/htdocs)
4. Run your php-server engine (Apache, NGinx)
5. Run your MySQL database, make sure you have already imported the database to your local machine.

You can then access the application through the following URL:

~~~
http://localhost/basic/web/
~~~

CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=green_ui_ac_id_1',
    'username' => '<YOUR_ROOT_USER>',
    'password' => '<YOUR_ROOT_PASS>',
    'charset' => 'utf8',
];
```

## History

May 2016, version v0.1

## Credits

- I Made Sanadhi Sutandi (https://github.com/sanadhis)
- Suryo Satrio
- Martin Dominikus
- Supervisor >> Prof. Ir. Riri Fitri Sari S.T., M.M., M.Sc.
- Supervisor >> Bapak Misbahuddin
- PSSI Server' Admin >> Ndaru Widya

## License

License by Universitas Indonesa' Green Project
- >> Green Transportation System' Research Cluster
- >> Computer Engineering Universitas Indonesia
- >> Department of Electrical Engineering, Universitas Indonesia

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.
- Refer to the README in the `tests` directory for information specific to basic application tests.
# Nebeng-Web
