## Installation

* Clone the project
    `git clone https://github.com/mansidesai631/customer-management`

* Go to the project directory
    `cd customer-management`

* run composer
    `composer install` and also run `npm install` and `npm run dev`

* Create a .env file from .env.example
    `cp .env.example .env`

* Generate application key
    `php artisan key:generate`

* Create database in mysql

* Database migration
    `php artisan migrate`

* Seed database
    `php artisan db:seed`

* Serve Application
    `php artisan serve`

* This will create admin user for your application which
    username : `admin@gmail.com`
    password `secret`
