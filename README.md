# Simple-PHP-User-Management-CRUD-
This is a simple CRUD (Create, Read, Update, Delete) application built with PHP that allows you to manage user records.

## Features

- Add a new user with their name, email, last name, country, zipcode, city, occupation, gender, phone, and website.
- View a list of all users with pagination support.
- Sort the user list by name or email in ascending or descending order.
- Edit the details of a user.
- Delete a user from the records.

## Prerequisites

- PHP 5.6 or above
- MySQL database

## Installation

1. Clone the repository or download the source code.

git clone 


2. Create a MySQL database and import the provided SQL file `users.sql` to create the required `users` table.

mysql -u [username] -p [database_name] < users.sql



3. Update the database connection details in the `index.php` and other relevant files if necessary.

```php
$server = "localhost";
$username = "your_username";
$password = "your_password";
$database = "your_database_name";

$conn = mysqli_connect($server, $username, $password, $database);
```
Start your web server (e.g., Apache) and navigate to the application's root directory in your web browser.

## Usage

- To add a new user, click on the "Add User" link and fill in the required details.
- To view the list of users, visit the main page.
- Use the search box to search for any data in table.
- Sort the user list by clicking on the column headers.
- To edit a user's details, click on the "Edit" link next to their record.
- To delete a user, click on the "Delete" link next to their record.

