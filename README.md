# Task Manager

This is a simple PHP project for managing tasks. It includes user registration, task management, and hierarchical task display, all built using object-oriented principles. The project uses interfaces, repositories, and services to structure the code, and database interaction is handled via PDO.

## Features
- User registration with secure handling of form data using `POST` method.
- Task management with hierarchical display of tasks (parent-child relationship).
- Bootstrap-styled form with responsive design for registration.
- Object-Oriented Programming (OOP) principles: interfaces, repositories, services.
- PDO-based connection to the database for handling users and tasks.

## Prerequisites
To run this project, you need to have the following installed on your machine:
- PHP (v7.4 or higher)
- Apache web server (or any other compatible web server)
- OpenServer (Windows) or LAMP stack (Linux)
- MySQL or any other database that supports PDO

## Installation

### Step 1: Clone the repository
To download the project files to your machine, clone this repository:

```bash
git clone https://github.com/yourusername/task-manager.git
```

### Step 2: Move the project to the web server directory
For Ubuntu with LAMP, move the project to Apache's web directory:

```bash
sudo mv /path/to/cloned/repository/task-manager /var/www/html/
```

For Windows with OpenServer, move the project to the `domains` directory, usually located at `C:/OpenServer/domains/task-manager`.

### Step 3: Set proper permissions (for Linux)
Make sure the web server has the appropriate access to the project files:

```bash
sudo chmod -R 755 /var/www/html/task-manager
```

### Step 4: Configure the database
1. Create a database for the project:
   ```bash
   mysql -u root -p
   CREATE DATABASE task_manager;
   ```
2. Import the database schema (if available) or create the necessary tables manually.
3. Update the database connection settings in `config/config.php`:
   ```php
   'db' => [
       'host' => 'localhost',
       'dbname' => 'task_manager',
       'user' => 'root',
       'password' => '',
       'charset' => 'utf8'
   ]
   ```

### Step 5: Start Apache
Make sure your web server (Apache) is running. You can start or check the status using the following command for Linux:

```bash
sudo systemctl start apache2
sudo systemctl status apache2
```

For Windows, start OpenServer by clicking the green flag in the OpenServer control panel.

## Usage
Once everything is set up, you can access the application in your browser.

### Registration
For Ubuntu with LAMP, open:

```
http://localhost/task-manager/register.php
```

For Windows with OpenServer, use the following:

```
http://task-manager/register.php
```

### Tasks
To view the list of tasks:

```
http://localhost/task-manager/tasks.php
```

## Project Structure
- **public/**
  - **index.php**: Main entry point for routing the application.
  - **register.php**: Handles user registration.
  - **tasks.php**: Displays the list of tasks.
- **src/**
  - **Interfaces/**: Contains interfaces for repositories and database connections.
  - **Models/**: Contains the `User` and `Task` models.
  - **Repositories/**: Handles data interactions for users and tasks.
  - **Services/**: Contains services like `AuthService` for user registration and authentication.
  - **DB/**: Contains the `DBConnection` class that manages the database connection.
- **templates/**: Contains the HTML templates for `register.php` and `tasks.php`.
- **config/**: Contains the configuration file `config.php` for database settings.
- **vendor/**: Autoloaded classes and dependencies managed by Composer.

## License
This project is licensed under the MIT License.