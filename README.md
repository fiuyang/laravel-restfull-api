<a href="https://www.buymeacoffee.com/" target="_blank"><img src="https://cdn.buymeacoffee.com/buttons/default-black.png" alt="Buy Me A Coffee" style="height: 51px !important;width: 217px !important;" ></a>

Laravel app using service-repository pattern. You may use Postman or Unit Test to try the CRUD functionality. This is just for Backend only.

### Installation

- Copy or .env.example to .env (cp .env.example .env)
- Create or APP_KEY not env (php artisan key:generate)
- Create or JWT_SECRET not env (php artisan jwt:secret)
- composer install
- composer update
- composer migrate
- Roll: php artisan serve
- Test with the REST Client extension, not VSCode test-api-rest.http
  ou Test using o Postman
- Unit Test (php artisan test)

Index - GET - http://{localhost}/products <br />
Create - POST - http://{localhost}/products/?name={newName}&qty={newQty}&price={newPrice} <br />
Read - GET (all)- http://{localhost}/products/ <br />
       GET (byID) - http://{localhost}/products/{id} <br />
Update - PATCH -  http://{localhost}/products/{id}?name={updatedName}&qty={updatedQty}&price={updatedPrice} <br />
Delete - DELETE - http://{localhost}/products/{id} <br />
                  