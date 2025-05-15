Prerequisites
Before running the application, ensure you have the following installed:

PHP 8.1+

Composer (for PHP package management)

SQLite (or any other database if you decide to switch)

Installation
1 - Clone the repository:
    git clone https://github.com/wcast23/user-management-system.git
    cd user-management-system

2 - Install the dependencies:
    In the proejct root directory execute:
        composer install

3 - Set up your environment variables:
    cp .env.example .env

4 - Set up SQLite database:
    Make sure to configure SQLite in the .env file:

    DB_CONNECTION=sqlite
    DB_DATABASE=your-database-path/user_management_system.sqlite

    - Create the database file in the following location:
        App/database/user_management_system.sqlite

5 - Run the migrations and seeders:
    php artisan migrate
    This will create the database structure.

    php artisan db:seed --class=UserSeeder
    This will populate the database by executing the specific seeder created "UserSeeder"
    database/seeders/UserSeeder

Running the Project

To start the application, you can use the built-in Laravel development server:
    php artisan serve
    By default, the app will be accessible at http://localhost:8000.

--------------------------------------------------------------------
API Endpoints

GET /users - List all users
Retrieve a paginated list of users.

Query Parameters:

name: Filter users by name.
email: Filter users by email.


POST /users - Create a new user
Create a new user by passing the following data in the request body:
    {
        "name": "John Doe",
        "email": "john@example.com",
        "password": "password123",
        "phone_number": "1234567890"
    }

GET /users/{id} - Retrieve a specific user
Get the details of a user by ID.

PUT /users/{id} - Update an existing user
Update an existing user's details. Pass the fields you want to update in the request body.

DELETE /users/{id} - Delete a user
Delete a user by their ID.

----------------------------------------------------------------------
Testing

You can test the endpoints using Postman or any other API testing tool.

Example for GET /users (List Users):
Filter by name:
Request:
    GET http://localhost:8000/api/users?name=John

Filter by email:
Request:
    GET http://localhost:8000/api/users?email=jose.cole@example.com

Response:
    {
  "data": [
    {
        "id": 1,
        "name": "Rhiannon Witting",
        "email": "jose.cole@example.com",
        "phone_number": "925.322.2760",
        "created_at": "2025-05-15T01:40:22.000000Z",
        "updated_at": "2025-05-15T01:40:22.000000Z"
    },
    ...
  ]
}


Example for POST /users (Create User):
Request:
    {
        "name": "Jane Doe",
        "email": "jane@example.com",
        "password": "password123",
        "phone_number": "0987654321"
    }

    Response:
        {
            "id": 2,
            "name": "Jane Doe",
            "email": "jane@example.com",
            "phone_number": "0987654321",
            "created_at": "2025-05-14T10:10:00.000000Z",
            "updated_at": "2025-05-14T10:10:00.000000Z"
        }







