<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Добро пожаловать в Менеджер задач!</h1>
        <p>Это простое PHP приложение для управления задачами. Используйте меню для регистрации и просмотра задач.</p>
        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Кнопки для авторизованного пользователя -->
            <a href="/tasks" class="btn btn-primary">Посмотреть задачи</a>
            <a href="/logout" class="btn btn-danger">Выйти</a>
        <?php else: ?>
            <!-- Кнопки для неавторизованного пользователя -->
            <a href="/register" class="btn btn-primary">Зарегистрироваться</a>
            <a href="/login" class="btn btn-secondary">Войти</a>
        <?php endif; ?>
    </div>
</body>
</html>
