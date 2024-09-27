# Task Manager

This is a simple PHP project that includes a user registration page. The registration form sends user data to the server via the POST method and uses Bootstrap for styling.

## Features
- PHP-based user registration form.
- Secure handling of form data using `POST` method.
- Bootstrap-styled form with responsive design.

## Prerequisites
To run this project, you need to have the following installed on your machine:
- PHP (v7.4 or higher)
- Apache web server (or any other compatible web server)
- OpenServer (Windows) or LAMP stack (Linux)

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

### Step 4: Start Apache
Make sure your web server (Apache) is running. You can start or check the status using the following command for Linux:

```bash
sudo systemctl start apache2
sudo systemctl status apache2
```

For Windows, start OpenServer by clicking the green flag in the OpenServer control panel.

## Usage
Once everything is set up, you can access the registration page in your browser.

For Ubuntu with LAMP, open:

```
http://localhost/task-manager/register.php
```

For Windows with OpenServer, use the following:

```
http://task-manager/
```

## Project Structure
- **register.php**: The main PHP file that contains the form and logic to handle user registration via POST request.
- **Bootstrap**: Linked via CDN for styling and responsive layout.

## License
This project is licensed under the MIT License.
