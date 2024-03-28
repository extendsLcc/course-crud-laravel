# Course CRUD with Laravel, Vue and Hybridly

This project is a simple system for registering and managing courses and their video lessons for online education. It was developed to familiarize with the Laravel framework, Vue.js, and Hybridly (an Inertia.js alternative).

## Table of Contents

- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Running the Project](#running-the-project)
- [Technologies](#technologies)

## Prerequisites

Before you begin, ensure you have met the following requirements:

- You have installed Docker.

## Installation

To install the project, follow these steps:

1. Clone the repository:
    ```
    git clone https://github.com/extendsLcc/course-crud-laravel
    ```

    You can execute all commands bellow be executing start-project.sh script
    ```bash
    sh start-project.sh
    ```
    or if you prefer to execute each step manually follow the steps bellow.

2. Install PHP dependencies:
    ```
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd):/var/www/html" \
        -w /var/www/html \
        laravelsail/php83-composer:latest \
        composer install --ignore-platform-reqs
    ```

3. Copy the example environment file and make the required configuration changes in the `.env` file:
    ```
    cp .env.example .env
    ```

4. Start the project container:
    ```
    ./vendor/bin/sail up -d
    ```

5. Run database migrations:
    ```
    ./vendor/bin/sail artisan migrate
    ```

6. Run database seeders:
    ```
    ./vendor/bin/sail artisan db:seed
    ```

7. Install front-end dependencies:
    ```
    ./vendor/bin/sail bun install
    ```

## Running the Project

To run the project, follow these steps:

1. Start the Laravel server:
    ```
    ./vendor/bin/sail up -d
    ```

2. Start the front-end development server:
    ```
    ./vendor/bin/sail bun run dev
    ```

The application will be available at [http://localhost](http://localhost) by default.

## Technologies

The project was developed using the following technologies:

- **[Laravel](https://github.com/laravel/laravel)**: Opted for not changing much of the default structure because the size of the project and to make use of laravel idea code generation.
- **[Hybridly (Inertia Alternative)](https://github.com/hybridly/hybridly)**: First time using it. It's basically inertia.js on steroids, it comes with a lot of preconfigured stuff that makes the development process much faster, instead of wasting time configuring inertia.js, I can focus on the project itself. 
    <br>Its focus on Laravel and Vue.js provides features that Inertia.js doesn't have. Also even though it's not as popular as Inertia.js, its maintainers are very active (surprisingly more than Inertia.js) and is really reliable.
- **[Spatie/laravel-data](https://github.com/spatie/laravel-data)**: Almost mandatory for Hybridly, makes end-to-end type-safety possible.
- **[Spatie/laravel-route-attributes](https://github.com/spatie/laravel-route-attributes)**: Makes the routes more readable and easier to maintain.
- **[Vue.js](https://github.com/vuejs/core)**: I have very little experience with Vue.js, but the first impression was extremely positive.
- **[Radix-Vue](https://github.com/radix-vue/radix-vue)**: I have never used it before, looks very powerful and easy to use, it's actually has more features then React's Radix-UI itself.
- **[Shadcn-Vue](https://github.com/radix-vue/shadcn-vue)**: Preset design system for Radix-Vue, also first time using it.

[Back to Top](#course-crud-with-laravel-vue-and-hybridly)
