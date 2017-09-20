Symfony SoQut
====

The SoQut Symfony project

To use it :

```bash
composer install
mkdir var/data
bin/console doctrine:schema:update --force
bin/console fos:user:create admin admin@admin.com admin
bin/console fos:user:promote admin ROLE_ADMIN
bin/console assets:install
bin/console server:run
```

go to 127.0.0.1:8000 on your web browser
