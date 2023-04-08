## Harde Business School Assessment
This is a short coding assessment, in which you will implement a REST API that calls an external
API service to get information about books. Additionally, you will implement a simple CRUD
(Create, Read, Update, Delete) API with a local database of your choice.

•	Author: [Solomon Sunmola](https://github.com/Epheoluwa) <br>
•	Twitter: [@ifegracelife](https://twitter.com/ifegracelife) <br>
•	Portfolio: [Solomon](https://epheoluwa-portfolio.netlify.app/) <br>

## Project Setup
```
git clone git@github.com:Epheoluwa/Harde.git
cd Harde
composer install
cp .env.example .env 
php artisan key:generate
php artisan cache:clear && php artisan config:clear 
```

## Database Setup
Different CRUD request will be performed using local storage so we need to setup our database connection
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=root
DB_PASSWORD=
```

Next up, if you are using the ```MYSQL DATABASE``` or any other database, there is need to create the database which will be grabbed from the ```DB_DATABASE``` environment variable. ```MYSQL``` database query written below
```
mysql;
create database database_name;
exit;
```

Finally, run the code below to make migrations.
```
php artisan migrate
```

### Run the application

```
php artisan serve
```

## Requirement 1

```ruby
GET http://127.0.0.1:8000/api/external-books?name=:nameOfBook
```
The search query parameter[book name] can be written with space i.e  ```A Game of Thrones```

## Requirement 2
### Create
Post book record to the database using the following parameters which are all required
•	name <br>
•	isbn - [This field is Unique] <br>
•	authors <br>
•	country <br>
•	number_of_pages <br>
•	publisher <br>
•	release_date <br>

```ruby
POST http://127.0.0.1:8000/api/v1/books
```

### Read
Get all book record from database. The api accept the following search parameter for sorting ```name(string), country(string), publisher(string), release date(year,integer)```

```ruby
GET http://127.0.0.1:8000/api/v1/books
```
Example below using the search query parameter

```ruby
GET http://127.0.0.1:8000/api/v1/books?name=book
```

### Update
Update any of the book record stored in the database, this api takes an ```id``` parameter which is an ```integer``` and the data which you want to update
```ruby
PATCH http://127.0.0.1:8000/api/v1/books/:id
```

### Delete
Delete any of the book record stored in the database, this api takes an ```id``` parameter which is the id of the book to be deleted.
```ruby
DELETE http://127.0.0.1:8000/api/v1/books/:id
```

### Show
Show specific book record stored in the database, this api takes an ```id``` parameter which is the id of the book you want to recieve back.
```ruby
GET http://127.0.0.1:8000/api/v1/books/:id
```

## Testing
Test class and methods has be written run the command below to test code
```
php artisan test
```
To view response gotten for each test on terminal, include this command to the method
```ruby
$response->dd();
```
