**Project setup**

- clone it
- create .env and .env.testing files with DB configuration
- run *composer install*
- start beanstalkd service on 11300 port or change the port in queue config file
- run migrations *php artisan migrate*
- run migrations for test database *php artisan migrate --database=mysql_test*
- run *php artisan queue:work*

**Console commands**

- php artisan download:add _url_to_resource_
- php artisan download:list

**Running tests**

- phpunit