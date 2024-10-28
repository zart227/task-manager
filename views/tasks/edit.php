<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать задачу</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Редактировать задачу</h1>

        <form action="/task/edit/<?php echo htmlspecialchars($task->getId()); ?>" method="post">
            <div class="form-group">
                <label for="name">Название:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($task->getName()); ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Описание:</label>
                <textarea id="description" name="description" class="form-control" rows="4" required><?php echo htmlspecialchars($task->getDescription()); ?></textarea>
            </div>

            <div class="form-group">
                <label for="status">Статус:</label>
                <select id="status" name="status" class="form-control">
                    <option value="in_progress" <?php if ($task->getStatus() === 'in_progress') echo 'selected'; ?>>В процессе</option>
                    <option value="completed" <?php if ($task->getStatus() === 'completed') echo 'selected'; ?>>Завершено</option>
                    <option value="pending" <?php if ($task->getStatus() === 'pending') echo 'selected'; ?>>В ожидании</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
            <a href="/tasks" class="btn btn-secondary ml-2">Назад к списку задач</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
