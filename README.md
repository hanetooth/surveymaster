# Survey Master
To streamline the process of creating, distributing, and analyzing surveys and forms. Whether you need to gather feedback, conduct research, or collect data from your audience, this app provides an intuitive platform to create custom surveys, share them with participants, and gain valuable insights through comprehensive analytics.

NOTE: A Backend Coding Test Project

### Project Setup

#### 1. Clone the repository

#### 2. Install dependencies
```bash
composer install
```
#### 3. Generate `APP_KEY`
```bash
php artisan tinker
```
#### 3. Create a database
#### 4. Set Environment Variables
Copy the `.env.example` file to `.env` for database configuration and mail configuration.
#### 5. Database Migration and Seeding
Database seeding is necessary to create the default inputs for form builder Api.
```bash
php artisan migrate --seed
```
#### 6. Initiate the Queue Worker
```bash
php artisan queue:work
```
#### 7. Run the application
```bash
php artisan serve
```
### API Documentation
https://documenter.getpostman.com/view/6108589/2s9Xy3sB2f

If you prefer local, There is a Postman collection in the root directory of the project. You can import it to Postman to read the Api documentation and test the API endpoints.

#### Minor Usage Guide
Use Api endpoints to create a new user and login to the application. Then use the token to access the protected endpoints.
After authentication, you can create a new form with default inputs. Please click to the Api documentation for further information.  
Api will provide public form URL in the response. You can use it to test the form submission.
### Open-Source Credits
- [Laravel](https://laravel.com/)
- [Laravel Sanctum](https://laravel.com/docs/10.x/sanctum)
- [Laravel Model Hashids](https://github.com/deligoez/laravel-model-hashid)
- [Tailwind CSS](https://tailwindcss.com/)
- [Responsive Form By maddog986](https://tailwindcomponents.com/component/responsive-form-1)

