## Laravel based PHP Ecommerce-cms System

Ecommerce-cms is simple starting project to create ecommerce sites.

## Basic Features

- Laravel framework 5.5 LTS
- Bootstrap
- Thin Controllers
- Easy migration and auto generated seed
- Repository Patterns and Services
- Translation
- Currency change
- SEO friendly Routes
- Ajax and non ajax search
- Autocomplete and normal search
- Ajax and non ajax Pagination
- Products filters
- Product Iframe with fancySelect.js
- User roles and Permission
- Change user roles and permission
- Change Parent and subcategories
- Test Demo users
- CRUD for products, orders in backend
- Backend admin and user panel
- Login
- Registration and Email Verification with Activation Code
- Simple taxes and countries vats
- Test demo orders
- Complete Shopping Cart
- Simple discounts
- PayPal checkout Express demo payments
- Social Authentication with Socialite

##  Todo:
Laravel based PHP Ecommerce-cms it's not complete ecommerce platform,
project is starting point for simple ecommerce sites.

- Need more strong and complete validation.
- Complete support and managment for vat, taxes and shippings.
- Complete support for Paypal payments, orders, transactions
  including Credit Card support etc.
- Shopping cart improvements.
- Ecommerce-cms use https://github.com/zofe/rapyd-laravel for CRUD so 
if you need CRUD for more tables add appropriate methods and routes.

## Notice:

- The project is free to use but I can't offer support for it because I am very busy,
so pull request are welcome. I will provide only minor updates.
- Database will be reset every month.
- For local development like PayPal test payments and social login you need to set your own 
apps with proper user  data in config files and services.



## Official Documentation

Complete documentation for the this project it's not ready yet.
If you want to test repository you must:
* Clone the repo
* Database
  * `create database with name cms`
* Create .env file and set
  * `DB_DATABASE=cms`
  * `DB_USERNAME=root`
  * `leave password blank`
* Run by performing on the repo's folder to install all dependencies:
  * `$ composer update`
* Now
  * `$ php artisan migrate`
* Fill the database
  * `$ php artisan db:seed`
* then run
  * `$ php artisan serve`  
* And access
  * `http://127.0.0.1:8000/cms`
  
