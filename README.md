## What is this?

A basic task manager API, with Laravel 10

## Commands

Start the service:
`php artisan serve`

Fresh migration:
`php artisan migrate:fresh`

Show the routes list:
`php artisan route:list`

Create a factory for a model:
`php artisan make:factory TaskFactory --model=Task`

Generate data for a model:
`php artisan tinker`

`Task::factory(50)->create()`

## Plugins

- Laravel Query Builder (Sort, filtering & pagination): https://github.com/spatie/laravel-query-builder
- Laravel Sanctrum (API Authentication): https://laravel.com/docs/10.x/sanctum



