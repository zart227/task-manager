# Task Manager

This is a simple PHP project for managing tasks and users. The project is built using Object-Oriented Programming (OOP) principles, and design patterns such as Singleton, Factory Method, Strategy, and Facade are used to make the system more modular, flexible, and maintainable.

## Features
- **User registration** with secure handling of form data using the `POST` method.
- **Task management** with hierarchical display of tasks (parent-child relationship).
- **Design Patterns**:
  - **Singleton** for database connection management.
  - **Factory Method** for creating tasks and users.
  - **Strategy** for different ways of displaying tasks (tree view or list view).
  - **Facade** to simplify the interaction with tasks and users through repositories and factories.
- **Bootstrap-styled form** with a responsive design for registration.

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
  - **Interfaces/**: Contains interfaces for factories, strategies, and database connections.
  - **Models/**: Contains the `User` and `Task` models.
  - **Repositories/**: Handles data interactions for users and tasks.
  - **Factories/**: Contains factories for creating `User` and `Task` objects using the Factory Method pattern.
  - **Strategies/**: Contains strategies for displaying tasks (tree view or list view).
  - **Services/**: Contains services like `AuthService` for user registration and `SessionManager` for managing user sessions.
  - **Facades/**: Contains the `TaskManagerFacade` to simplify task and user management.
  - **DB/**: Contains the `DBConnection` class that manages the database connection using the Singleton pattern.
- **templates/**: Contains the HTML templates for `register.php` and `tasks.php`.
- **config/**: Contains the configuration file `config.php` for database settings.
- **vendor/**: Autoloaded classes and dependencies managed by Composer.

## Design Patterns Implemented
- **Singleton**: Used in `DBConnection` to ensure only one database connection is instantiated.
- **Factory Method**: Used in `UserFactory` and `TaskFactory` to encapsulate the creation of users and tasks.
- **Strategy**: Used in `TreeTaskDisplayStrategy` and `ListTaskDisplayStrategy` to define different ways of displaying tasks.
- **Facade**: `TaskManagerFacade` simplifies interactions with tasks and users by providing a higher-level interface for working with repositories and factories.

## License
This project is licensed under the MIT License.