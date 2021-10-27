1) Clone the project
  `git clone https://github.com/mansidesai631/customer-management`
2)Go to the project directory
  `cd customer-management`
3)run composer
  `composer install` and also run `npm install` and `npm run dev`
4)Create a .env file from .env.example
    `cp .env.example .env`
5)Generate application key
    `php artisan key:generate`
6)Create database in mysql
7) Database migration
    `php artisan migrate`
8) Seed database
    `php artisan db:seed`
9) Serve Application
    `php artisan serve`
10) This will create admin user for your application which
    username : `admin@gmail.com`
    password `secret`
