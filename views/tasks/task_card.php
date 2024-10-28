<?php /** @var Arthur\TaskManager\Models\Task $task */ ?> 
<?php 
// Определяем стили и текст для статуса задачи
switch ($task->getStatus()) {
    case 'completed':
        $statusClass = 'bg-success text-white';
        $statusText = 'Завершено';
        break;
    case 'in_progress':
        $statusClass = 'bg-info text-white';
        $statusText = 'В процессе';
        break;
    case 'pending':
        $statusClass = 'bg-warning text-dark';
        $statusText = 'В ожидании';
        break;
    default:
        $statusClass = 'bg-secondary text-white';
        $statusText = 'Неизвестный статус';
        break;
}
?>

<div class="card my-3 <?php echo $statusClass; ?>" style="margin-left: <?php echo ($level * 20); ?>px;">
    <div class="card-body">
        <h5 class="card-title"><?php echo htmlspecialchars($task->getName()); ?></h5>
        <p class="card-text"><strong>Описание:</strong> <?php echo htmlspecialchars($task->getDescription()); ?></p>
        <p class="card-text"><strong>Статус:</strong> <?php echo $statusText; ?></p>

        <a href="/task/edit/<?php echo $task->getId(); ?>" 
            class="btn btn-sm btn-secondary mr-2">Редактировать
        </a>
        <a href="/task/delete/<?php echo $task->getId(); ?>" 
            class="btn btn-sm btn-danger mr-2" 
            onclick="return confirm('Вы уверены, что хотите удалить эту задачу?')">Удалить            
        </a>
        <a href="/task/create?parentId=<?php echo $task->getId(); ?>" 
            class="btn btn-sm btn-primary">Добавить подзадачу
        </a>
    </div>
</div>
