# Mini Blog (PHP application)
***
(A french version of this document exists : see README_fr.md)

## Table of contents

1. [Description](#description)
2. [Features](#features)
3. [Technologies used](#technologies-used)
4. [Installation](#installation)
5. [Demo](#demo)
6. [License](#license)


## Description

Mini Blog is a simple PHP application designed to showcase basic blog post management and user authentication. This project includes features like the creation, display, update and deletion of blog posts, user registration and login, and error handling.


## Features

- **User authentication** : secure user registration and login functionality.
- **Post creation** : a logged-in user can publish a post.
- **List of blog posts** : displays a list of posts on the homepage, with each post showing the author and creation date.
- **Post display** : users can click on a post title to view the full content of that specific post.
- **Update and delete post** : the author of a post (and only the author) can update or delete it.
- **Error handling** : centralized error management with error log and user-specific error messages.
- **Data validation** : validation and sanitization of user input.


## Technologies used

- PHP (with PDO for database interaction)
- MySQL
- phpMyAdmin
- Bootstrap 5.3 for responsive design and layout.
- HTML/CSS for structure and styling.
- JavaScript for basic dynamic interactions (password validation, modal alerts).


## Installation

### Prerequisites

- PHP 8.2 or higher
- MySQL/MariaDB 10.4 or higher
- A PHP-compatible web server (Apache, for example)

### Installation steps

1. **Download the source code**

   Clone this repository or download the source code.

2. **Create the database**

   Run the `mini_blog.sql` file to create the database and the necessary tables. Use the following command in your terminal:
   ```
   mysql -u [username] -p < mini_blog.sql
   ```
   (Replace [username] with your MySQL/MariaDB username. You will be prompted to enter your password.)

3. **Configure the database connection**

    Create a configuration file to define the database connection settings. 

    For example, you can create config/database.php with the following content :
    ```
    <?php

    return [
        'db_host' => 'localhost',
        'db_port' => 3306,
        'db_name' => 'mini_blog',
        'db_user' => 'root',
        'db_password' => '',
    ];
    ```

4. **Configure the web server**

    Make sure your web server is pointing to the directory where the PHP application files are located.

5. **Check Installation**

    Open a web browser and navigate to the URL where the application is hosted to verify that everything is working correctly.


## Demo

The mini_blog.sql file includes a sample author and a few sample blog posts, to help you test the application without needing to create a user account or posts :

    Author:
        E-mail: fictive-author@example.com
        Username: FictiveAuthor
        Password: Password#1

    Sample blog posts:
        "Welcome to Mini Blog!"
        "Long text example"


## License

This project is licensed under the MIT License. See the LICENSE file for more details.
