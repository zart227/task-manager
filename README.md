# Laravel Task Manager API

REST API для управления задачами с поддержкой вложенных задач и загрузки изображений.

## Требования

- PHP 8.2+
- Расширение GD для обработки изображений
- Laravel 10.x
- MySQL 5.7+ или PostgreSQL 9.6+

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
6. Создайте символическую ссылку для хранения файлов:
   ```bash
   php artisan storage:link
   ```
7. Установите расширение GD для PHP (если не установлено):
   ```bash
   sudo apt-get install php8.2-gd
   ```
8. Запустите сервер:
   ```bash
   php artisan serve
   ```

## API Документация

### Аутентификация

API использует токены для аутентификации через Laravel Sanctum. Все защищенные маршруты требуют заголовок `Authorization: Bearer {token}`.

#### Регистрация

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

#### Вход

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

#### Выход

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

#### Получение информации о пользователе

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

### Управление задачами

#### Создание задачи

```http
POST /api/tasks
Authorization: Bearer {token}
Content-Type: multipart/form-data

{
    "name": "Название задачи",
    "description": "Описание задачи",
    "status": "pending",
    "parent_id": null,
    "image": <file> // опционально
}
```

Ответ (201 Created):
```json
{
    "data": {
        "id": 1,
        "name": "Название задачи",
        "description": "Описание задачи",
        "status": "pending",
        "parent_id": null,
        "user_id": 1,
        "image_url": "http://example.com/storage/tasks/image.jpg",
        "created_at": "2024-02-19T17:00:00.000000Z",
        "updated_at": "2024-02-19T17:00:00.000000Z"
    }
}
```

#### Обновление задачи

```http
PUT /api/tasks/{id}
Authorization: Bearer {token}
Content-Type: multipart/form-data

{
    "name": "Новое название",
    "description": "Новое описание",
    "status": "completed",
    "parent_id": null,
    "image": <file> // опционально
}
```

Ответ (200 OK):
```json
{
    "data": {
        "id": 1,
        "name": "Новое название",
        "description": "Новое описание",
        "status": "completed",
        "parent_id": null,
        "user_id": 1,
        "image_url": "http://example.com/storage/tasks/new-image.jpg",
        "created_at": "2024-02-19T17:00:00.000000Z",
        "updated_at": "2024-02-19T17:00:00.000000Z"
    }
}
```

#### Получение списка задач

```http
GET /api/tasks
Authorization: Bearer {token}
```

#### Получение конкретной задачи

```http
GET /api/tasks/{id}
Authorization: Bearer {token}
```

#### Удаление задачи

```http
DELETE /api/tasks/{id}
Authorization: Bearer {token}
```

### Работа с изображениями

- Максимальный размер загружаемого изображения: 2MB
- Поддерживаемые форматы: jpeg, png, bmp, gif, svg, webp
- Изображения хранятся в директории `storage/app/public/tasks`
- URL изображений доступен через поле `image_url` в ответе API

## Тестирование

Для запуска тестов API выполните:
```bash
php artisan test tests/Feature/Api
```
