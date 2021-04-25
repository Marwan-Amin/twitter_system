# Technology stack used

 
- PHP 7.4
- Laravel 8 latest version
- MySQL latest version
- Docker


# Deployment steps

 
- You can run the application with one command in the terminal by executing this bash script to make all the work done for you.
	> sudo bash build.sh

- If you want to run the application outside docker, just follow these steps:
	> git clone git@github.com:Marwan-Amin/twitter_system.git

	> cd twitter_system

	> cd twitter

	> composer install

	> php artisan migrate:fresh
    
	> php artisan passport:install --force

	> php artisan storage:link

	> php artisan config:cache

	> php artisan route:cache

	> php artisan serve
