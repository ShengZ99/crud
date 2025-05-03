# crud
- First you will need to download the zip file
- Extract the zip file
- Open cmd and locate to the project folder
- Run composer install
- Rename .env.example to .env
- Make sure that DB_CONNECTION is mysql, DB_PORT is 3306, DB_DATABASE is crud
- Run php artisan migrate using cmd
- Run php artisan key:generate
- Run php artisan storage:link
- Run php artisan serve to run the project


To avoid database installation failure, I have uploaded sql file for phpmyadmin mysql. Do this if you are going to add database manually
- Create a new database called crud
- insert users.sql into the database
- Make sure that .env DB_CONNECTION is mysql, DB_PORT is 3306, DB_DATABASE is crud



**Some function is not able to finish on time. As my company did not use latest version on laravel before, so it
takes some time for me to notice that latest version 11 and 12 are removing Kernel, Middleware and api file from route.
So I just managed to finish CRUD function with an api function only.**
