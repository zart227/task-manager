<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Вход</h2>
        <?php if (isset($message)) { echo "<p class='alert alert-info'>$message</p>"; } ?>
        <form action="/login" method="POST" class="border p-4 shadow-sm">
            <div class="form-group">
                <label for="username">Имя пользователя</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Войти</button>
                <a href="/" class="btn btn-secondary">На главную</a>
            </div>
        </form>
    </div>
</body>
</html>
