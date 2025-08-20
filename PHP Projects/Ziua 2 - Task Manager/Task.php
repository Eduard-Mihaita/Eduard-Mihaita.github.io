<?php
require_once 'TaskManager.php';
class Task{
    public string $title;
    public string $description;
    public int $assigned_to;
    public string $priority;
    public string $due_date;
    private TaskManager $taskManager;

    public function __construct(string $title, string $description, int $assigned_to = 0, string $priority = 'Medie', string $due_date = "null")
    {
        $this->title = $title;
        $this->description = $description;
        $this->assigned_to = $assigned_to;
        $this->priority = $priority;
        $this->due_date = $due_date;
        $this->taskManager = new TaskManager();
    }

    public function save(): bool {
        return $this->taskManager->addTask($this->title, $this->description, $this->assigned_to, $this->priority, $this->due_date);
    }

    public function delete(int $task_id): bool {
        return $this->taskManager->deleteTask($task_id);
    }

}    
if ($_POST && isset($_POST['add_task'])) {
    $task = new Task(
        $_POST['title'],
        $_POST['description'],
        $_POST['assigned_to'],
        $_POST['priority'],
        $_POST['due_date']
    );
    if ($task->save()) {
        header('Location: index.php');
        exit;
    }
}
if ($_POST && isset($_POST['delete_task'])) {
    $task = new Task('', '');
    $task_id = (int)$_POST['task_id'];
    if ($task->delete($task_id)) {
        header('Location: index.php');
        exit;
    }
}

?>