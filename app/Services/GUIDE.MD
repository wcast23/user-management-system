Prerequisites
Before running the application, ensure you have the following installed:

PHP 8.1+

Composer (for PHP package management)

SQLite (or any other database if you decide to switch)

Installation
1 - Clone the repository:
    git clone https://your-repository-url.git
    cd user-management-system

2 - Install the dependencies:
    composer install

3 - Set up your environment variables:
    cp .env.example .env

4 - Set up SQLite database:
    Make sure to configure SQLite in the .env file:

    DB_CONNECTION=sqlite
    DB_DATABASE=database/database.sqlite

5 - Run the migrations and seeders:
    php artisan migrate --seed
    This will create the database structure and populate it with initial data.

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
Request:
    GET http://localhost:8000/api/users?name=John

Response:
    {
  "data": [
    {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "phone_number": "1234567890",
      "created_at": "2025-05-14T10:00:00.000000Z",
      "updated_at": "2025-05-14T10:00:00.000000Z"
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

Conclusion
This project provides a basic user management system that can be used as a foundation for further development. It allows you to handle user operations like CRUD and querying in an efficient manner. The setup with SQLite makes it lightweight and easy to manage for smaller applications.

This project is licensed under the MIT License - see the LICENSE file for details.






