How to launch a server:
php artisan migrate:fresh --env=testing;php artisan db:seed --class=DatabaseTestingSeeder --env=testing;$env:APP_ENV="testing"; php artisan serve

- Default Database:
To launch the default database, use the following command:
php artisan serve
This command starts the Laravel development server.

- Testing Database:
    - PowerShell:
    To launch the testing database in PowerShell, use the following command:
    $env:APP_ENV="testing"; php artisan serve

    This command configures the testing database as the default database when you launch the service.
    If you need to revert this configuration to launch the real default database, write the command:
    Remove-Item Env:APP_ENV. This command removes the environment variable `APP_ENV` to revert to the default configuration. Then, try again the command php artisan serve.

    - Bash:
    For Bash users, to launch the testing database use the following command:
    APP_ENV=testing php artisan serve

    To revert to the default database, stop the current service and run the command `php artisan serve`
