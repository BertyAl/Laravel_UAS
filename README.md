<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT)...

### Prerequisites

Make sure you have the following installed on your machine:
- [Composer](https://getcomposer.org/)
- [PHP](https://www.php.net/)
- [Node.js](https://nodejs.org/)
- [npm](https://www.npmjs.com/)
- [PostgreSQL](https://www.postgresql.org/)

### Installation

1. **Clone the repository and navigate into it:**
    ```sh
    git clone <repository-url>
    cd <repository-directory>
    ```

2. **Install PHP dependencies:**
    ```sh
    composer install
    ```

3. **Set up environment configuration:**
    - Rename or copy `.env.example` to `.env`:
      ```sh
      cp .env.example .env
      ```

    - Generate the application key:
      ```sh
      php artisan key:generate
      ```

4. **Configure your database:**
    - Set your database credentials in the `.env` file:
      ```sh
      DB_DATABASE=your_database_name
      DB_USERNAME=your_database_username
      DB_PASSWORD=your_database_password
      ```

5. **Set up Braintree credentials for PayPal (optional):**
    - Add the following lines to your `.env` file:
      ```sh
      BRAINTREE_ENV=sandbox
      BRAINTREE_MERCHANT_ID=your_merchant_id
      BRAINTREE_PUBLIC_KEY=your_public_key
      BRAINTREE_PRIVATE_KEY=your_private_key
      ```

6. **Install Node.js dependencies:**
    ```sh
    npm install
    ```

7. **Run the development server:**
    ```sh
    npm run watch
    ```

### Running the Application

To start the Laravel development server, run:
```sh
php artisan serve
