<div align="center">
      <h1> <img src="https://thumbs.dreamstime.com/z/product-icon-symbol-creative-sign-quality-control-icons-collection-filled-flat-computer-mobile-illustration-logo-150923733.jpg" width="80px"><br/>API Product Test</h1>
     </div>


# Description
A simple API Product with CRUD function and JWT auth.

# Features
This API developed with PHP 8.0, Laravel Framework 9.0
 
# Tech Used
 ![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white) ![JWT](https://img.shields.io/badge/JWT-black?style=for-the-badge&logo=JSON%20web%20tokens) ![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white) ![PostgresSQL](https://img.shields.io/badge/postgresql-%23316192.svg?&style=for-the-badge&logo=postgresql&logoColor=white) ![Postman](https://img.shields.io/badge/Postman-FF6C37?style=for-the-badge&logo=postman&logoColor=white)
      
# Getting Start:
Before you running the program, make sure you've run this command:
- `composer install` or `composer update`
-  Rename `.env.example` to `.env`
-  Generate the jwt secret key with `php artisan jwt:secret`

### Database setup:
- Create your own database, and put the credential in env file
- Run the migration with `php artisan migrate`

### Run the program
- `php -S localhost:8000 -t public`
- `Unit Test (php artisan test)`

The program will run on http://localhost:8000

Index - GET - http://{localhost}/products <br />
Create - POST - http://{localhost}/products/?name={newName}&qty={newQty}&price={newPrice} <br />
Read - GET (all)- http://{localhost}/products/ <br />
       GET (byID) - http://{localhost}/products/{id} <br />
Update - PATCH -  http://{localhost}/products/{id}?name={updatedName}&qty={updatedQty}&price={updatedPrice} <br />
Delete - DELETE - http://{localhost}/products/{id} <br />
                  
