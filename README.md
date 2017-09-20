test
====

A Symfony project created on September 8, 2017, 7:56 am.

To test it :

```bash
git clone https://github.com/brunomartin/symfony-test.git
cd symfony-test
composer install
mkdir var/data
bin/console doctrine:schema:update --force
bin/console fos:user:create admin admin@admin.com admin
bin/console fos:user:promote admin RA
bin/console server:run
```

go to 127.0.0.1:8000 on your web browser
