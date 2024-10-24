<?php
// Функция для отображения задач в древовидном виде
function displayTasks(array $tasks, ?int $parentId = null, int $level = 0): void {
    foreach ($tasks as $task) {
        if ($task->getParentId() === $parentId) {
            echo str_repeat('&nbsp;', $level * 4) . 'Название: ' . htmlspecialchars($task->getName()) . '<br>';
            echo str_repeat('&nbsp;', $level * 4) . 'Описание: ' . htmlspecialchars($task->getDescription()) . '<br>';
            echo str_repeat('&nbsp;', $level * 4) . 'Статус: ' . htmlspecialchars($task->getStatus()) . '<br><br>';
            displayTasks($tasks, $task->getId(), $level + 1);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список задач</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Список задач</h2>
        <div class="tasks">
            <?php displayTasks($tasks); ?>
        </div>
    </div>
</body>
</html>
