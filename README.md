# Laminas tutorial

Laminas album tutorial done with MySQL database instead of Sqlite.

## Need to know

> - Run `composer install` before launch for the first time this project.  
> If you get error, execute this command : `composer install --ignore-platform-reqs` (man hack I know)

> - You can run project through command `composer serve` which will start it on http://127.0.0.1:8080/ by default. You can change it in composer.json

> - You can change MYSQL configuration in config/autoload.php. Then you will have to make `composer dump-autoload`. Then, for be sure of applied modifications,
> you can delete /data/cache/module-config-cache.application.config.cache.php for generate cache with your own configuration.

> - Unit tests has been added to Album module, you can try launch them by using `composer test Album`.

### Doctrine tips ###
> vendor\bin\doctrine.bat orm:schema-tool:update --dump-sql  [--force for apply changes]


### Contact me

- Discord: Bast#0207
- Mail: thomasleconte05@gmail.com