# Symfony CRUD ToDo App - team project

Symfony CRUD ToDo App.
TODO application does the basic operations: creating a task, reading tasks list, deleting a task, updating a task.

# Steps to follow

1. Copy the folder to SymfonyMAMP and rename to "web". Then cd to "web"
2. Install dependencies using `composer install`
3. Install front-end dependencies using `npm install`
4. Do the migration:

   - Open file .env in "SYMFONY-MAMP" folder (not the "web" folder!)
   - Rename database to `DATABASE_NAME=ToDOdb `. ToDOdb is the database we use for the to do list.
   - Open Docker > symfony-mamp_www_1 > CLI
   - cd to "web" folder
   - Run `php bin/console make:migration`
   - Run `php bin/console doctrine:migrations:migrate`. If you get errors that ToDOdb doesn't exist restart docker container a few times.

5. Afterwards you can run webpack encore using following command
   `npm run watch`
6. Start Symfony server: `symfony server:start`
7. Visit URL: http://localhost:8007/ to run the app
8. Use Crtl + C to stop the server and to stop the watch

# Tech stack

1.  [Symfony](https://symfony.com/)
2.  [PHP](https://www.php.net/)
3.  [Stimulus](https://stimulus.hotwired.dev)
4.  [MySQL](https://www.mysql.com)
5.  [SymfonyMAMP](https://github.com/kalwar/Symfony-MAMP)
