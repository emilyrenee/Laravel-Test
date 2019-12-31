

## Getting Started

### Requirements
- Docker
- PHP 7.3.11

### Running the app

From the root directory run the following:

`cp .env.example .env`  
`composer install`  
`php artisan key:generate`  
`docker-compose up -d --build` runs the db  
`php artisan migrate`  
`php artisan serve` serves backend and frontend assets  
`php artisan db:seed` gets you the data  
