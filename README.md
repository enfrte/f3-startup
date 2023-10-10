# Startup 

About...

**Framework:** Fat Free Framework (F3). 

**Datastorage:** SQLite


## Install on webhost

Install the dependencies managed by composer. 

Change .env_copy to .env and set the values to your own.

Navigate to `startup` and put the `startup` folder one directory back from the web root. 

Navigate to the `startup/public` folder and put startup folder in the web root. 

Get the OS path to the `startup` folder one directory back from the web root, and add as the values to 'ABSOLUTE_PRIVATE_APP_PATH' and 'UI' in index.php 

Log in to /admin, run the /install script to create the sqlite db. 

## Local dev

Run the composer setup. cd into the composer.json folder and run `composer install`

Get the OS path to the `startup/startup` folder and add as the values to 'ABSOLUTE_PRIVATE_APP_PATH' and 'UI' in index.php 

Navigate to `startup/public` and run `php -S localhost:8000`

Try http://localhost:8000/startup/

Or

If using XAMPP http://localhost/f3-startup/public/startup/

