# Laravel 12 - SimpleApp
This repository contains an application based on Laravel 12, a modern PHP framework. The project uses [Vite](https://vitejs.dev/) as the frontend asset bundler, providing a fast and optimized development experience.
This application allows authentication with Google OAuth and an administration panel with user information that is visible depending on the authenticated user.

## 🚀 App URL

🔗 **Access the application here: (Deployed using Google Cloud Run and Google Cloud SQL)** [SimpleApp](https://simpleapp-233965169733.us-central1.run.app/)

## Prerequisites

Make sure you have the following dependencies installed:

- [PHP](https://www.php.net/downloads) (8.2+ recommended)
- [Composer](https://getcomposer.org/)
- [Node.js and npm](https://nodejs.org/)
- [MySQL](https://www.mysql.com/)
- [Docker and Docker Compose](https://www.docker.com/get-started)

---

## Installation

Clone the repository and navigate to the project directory:

```sh
git clone https://github.com/DanielVasquezV/SimpleApp.git
cd SimpleApp
```

Install Laravel and Node.js dependencies:

```sh
composer install
npm install
```

Set up the environment file:

```sh
cp .env.example .env
```

Edit the `.env` file and update the database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=simpleapp
DB_USERNAME=your_user
DB_PASSWORD=your_password
```

Run migrations:

```sh
php artisan migrate
```

If prompted, confirm the creation of the `simpleapp` database.

Generate the application key:

```sh
php artisan key:generate
```

---

## Running the Project

Start the development server:

```sh
php artisan serve
```

The project uses Vite for asset bundling, so, you need to run the following command in a separate terminal:

```sh
npm run dev
```

This will enable fast reloading and optimized asset handling during development.

---

## Running Tests

This project includes unit and feature tests using [PHPUnit](https://phpunit.de/). To execute the test suite, run the following command:

```sh
php artisan test
```

To run a specific test, use:

```sh
php artisan test --filter=TestClassName
```
There are two tests: one called ```GoogleOAuthControllerTest```, which verifies the login of an existing user using the Google OAuth API, and another called ```CheckRoleTest```, which tests the function that determines whether the user is an admin based on specific conditions. Therefore, you can directly replace 'TestClassName' in the command with the name of the tests described.

## Docker

If you want to run the application locally using Docker, make sure you have Docker Engine running on your computer, then go to the project terminal and execute the following commands:

### Build the Docker images

```sh
docker-compose -f docker-compose.dev.yml build
```

### Start the containers

```sh
docker-compose -f docker-compose.dev.yml up -d
```

This will create the application along with its MySQL database on a container to access just go to ```http://localhost:8080/``` on your browser

Additionally, you can work with volumes in the application image, which, by linking the local source code directory to the corresponding directory within the container, allows any changes made to the code to be automatically reflected within the container. This enables more efficient development, as you don't need to rebuild the image or restart the container every time you make changes.

To set this, go to ```/docker-compose.dev.yml``` file and uncomment the volumes section (Note: If you use volumes, make sure your ```.env``` file is properly configured with the database settings. You can copy the contents of the ```.env.local``` file to the ```.env``` file for development purposes.):
```env
     volumes:
         - .:/var/www/html
         - './node_modules:/var/www/html/node_modules'
```
---
