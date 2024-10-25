<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Регистрация</h2>

        <!-- Сообщения об ошибках/успехах -->
        <?php if (isset($message)): ?>
            <div class="alert alert-info">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <!-- Форма отправляет данные методом POST -->
        <form action="/register.php" method="POST" class="border p-4 shadow-sm">
            <!-- CSRF токен -->
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? ''); ?>">

            <div class="form-group">
                <label for="username">Имя пользователя:</label>
                <input type="text" name="username" id="username" class="form-control" minlength="3" required>
                <small class="form-text text-muted">Имя пользователя должно быть не менее 3 символов.</small>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" name="password" id="password" class="form-control" minlength="6" required>
                <small class="form-text text-muted">Пароль должен быть не менее 6 символов.</small>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Зарегистрироваться</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
