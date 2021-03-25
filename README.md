# Examensarbete - a18eliek
## Requirements

 - [ ] PHP v7.3+ (8+ recommended)
 - [ ] Composer 2
 - [ ] NPM 7.6+
 - [ ] MySQL database
 - [ ] Google Cloud Platform API key

## Setup
 1. Download the repository to desired folder
 2. Download the composer packages: `composer update`
 3. Download all the required Node.js files: `npm update`
 4. Compile the React, Vue and SCSS: `npm run prod`
 5. Setup the Laravel Configuration:
 6. Copy the env:  `cp .env.example .env`
 7. Generate keys for Laravel: `php artisan key:generate`
 8. Make sure to change the following in `.env`: 
	```env
	DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=laravel
	DB_USERNAME=root
	DB_PASSWORD=password
	GOOGLE_MAPS_API=google_cloud_platform_key
	```
9. To start the application run:  `php artisan serve`