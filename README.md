<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Laravel Task Manager API

## Аутентификация

API использует токены для аутентификации через Laravel Sanctum. Все защищенные маршруты требуют заголовок `Authorization: Bearer {token}`.

### Регистрация

```http
POST /api/register

{
    "name": "Имя пользователя",
    "email": "user@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```

Ответ (201 Created):
```json
{
    "access_token": "1|abcdef...",
    "token_type": "Bearer",
    "user": {
        "id": 1,
        "name": "Имя пользователя",
        "email": "user@example.com",
        "created_at": "2024-02-19T17:00:00.000000Z",
        "updated_at": "2024-02-19T17:00:00.000000Z"
    }
}
```

### Вход

```http
POST /api/login

{
    "email": "user@example.com",
    "password": "password123"
}
```

Ответ (200 OK):
```json
{
    "access_token": "2|abcdef...",
    "token_type": "Bearer",
    "user": {
        "id": 1,
        "name": "Имя пользователя",
        "email": "user@example.com",
        "created_at": "2024-02-19T17:00:00.000000Z",
        "updated_at": "2024-02-19T17:00:00.000000Z"
    }
}
```

### Выход

```http
POST /api/logout
Authorization: Bearer {token}
```

Ответ (200 OK):
```json
{
    "message": "Успешный выход из системы"
}
```

### Получение информации о пользователе

```http
GET /api/user
Authorization: Bearer {token}
```

Ответ (200 OK):
```json
{
    "id": 1,
    "name": "Имя пользователя",
    "email": "user@example.com",
    "created_at": "2024-02-19T17:00:00.000000Z",
    "updated_at": "2024-02-19T17:00:00.000000Z"
}
```

## Установка и настройка

1. Клонируйте репозиторий
2. Установите зависимости:
   ```bash
   composer install
   ```
3. Скопируйте `.env.example` в `.env` и настройте подключение к базе данных
4. Сгенерируйте ключ приложения:
   ```bash
   php artisan key:generate
   ```
5. Выполните миграции:
   ```bash
   php artisan migrate
   ```
6. Запустите сервер:
   ```bash
   php artisan serve
   ```

## Тестирование

Для запуска тестов API выполните:
```bash
php artisan test tests/Feature/Api/AuthTest.php
```
