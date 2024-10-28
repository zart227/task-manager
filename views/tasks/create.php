<?php
$parentId = $_GET['parentId'] ?? null; // Определяем parent_id, если он передан
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создать задачу</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Создать новую задачу</h1>
        
        <form action="/task/create" method="post">
            <input type="hidden" name="parent_id" value="<?php echo htmlspecialchars($parentId); ?>">

            <div class="form-group">
                <label for="name">Название:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="description">Описание:</label>
                <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="status">Статус:</label>
                <select id="status" name="status" class="form-control">
                    <option value="in_progress">В процессе</option>
                    <option value="completed">Завершено</option>
                    <option value="pending">В ожидании</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Создать задачу</button>
            <a href="/tasks" class="btn btn-secondary ml-2">Назад к списку задач</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
