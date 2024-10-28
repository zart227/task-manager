<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список задач</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Список задач</h2>
        <div class="mb-4">
            <a href="/" class="btn btn-secondary">На главную</a>
            <a href="/task/create" class="btn btn-primary ml-2">Создать задачу</a>
        </div>
        
        <div class="tasks">
            <?php if (empty($tasks)): ?>
                <p class="text-center">У вас нет задач.</p>
            <?php else: ?>
                <?php
                    if (isset($displayStrategy)) {
                        echo $displayStrategy->display($tasks);
                    } else {
                        echo "Ошибка: стратегия отображения не установлена.";
                    }
                ?>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
