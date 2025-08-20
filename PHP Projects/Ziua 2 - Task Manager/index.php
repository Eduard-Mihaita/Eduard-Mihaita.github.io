<?php
require_once 'TaskManager.php';
$manager = new TaskManager();

// Exemplu pentru inițializare (fără useri): adaugă un user la început
if (empty($manager->getUsers())) {
    $manager->addUser('Edi Elev', 'edi@company.com', 'developer');
}
// Pentru sarcini, folosești $manager->addTask(...) etc.
if ($_POST){
    if (isset($_POST['add_task'])){
        $manager->addTask($_POST['title'], $_POST['description'], $_POST['assigned_to'], $_POST['priority'], $_POST['due_date']);
        header('Location: index.php');
        exit;
    }
}
$users = $manager->getUsers();
$tasks = $manager->getTasks();
?>

<!DOCTYPE html>
<html>
<html lang = "ro">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Manager Simplu</title>
    <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel = "stylesheet"/>
</head>
<body class = "container py-5">
    <div class = "card mb-3">
        <h1 class = "text-center">Task Manager</h1>
        <div class = "card-body">
            <form method = "POST" class = "mb-3">
                <label class = "form-label">Titlu</label>
                    <input type = "text" name = "title" class = "form-control" required></input>
                <label class = "form-label">Descriere</label>
                    <textarea name = "description" class="form-control" rows = "2" required></textarea>
                <label class = "form-label">Atribuit catre</label>
                    <input type = "number" name = "assigned_to" class = "form-control" required></input>
                <label class = "form-label">Prioritate</label>
                    <select name = "priority" class = "form-select" required>
                        <option value = "low">Scazuta</option>
                        <option value = "medium">Medie</option>
                        <option value = "high">Ridicata</option>
                    </select>
                <label class = "form-label">Deadline</label>
                    <input type = "date" name = "due_date"  class = "form-control" required></input>
                <button type = "submit" name = "add_task" class = "btn btn-primary">Adauga Task</button>
            </form>
        </div>
    </div>
    <table class = "table table-bordered">
        <thead>
            <tr>
                <th>Titlu</th>
                <th>Descriere</th>
                <th>Atribuit</th>
                <th>Status</th>
                <th>Prioritate</th>
                <th>Deadline</th>
                <th>Acțiuni</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?= htmlspecialchars($task['title']) ?></td>
                    <td><?= htmlspecialchars($task['description']) ?></td>
                    <td><?= htmlspecialchars($task['assigned_name']) ?></td>
                    <td><?= htmlspecialchars($task['status']) ?></td>
                    <td><?= htmlspecialchars($task['priority']) ?></td>
                    <td><?= htmlspecialchars($task['due_date']) ?></td>
                    <td>
                        <!-- Aici adaugi butoane pentru update/delete status (apelezi metodele deja scrise) -->
                         <form method = "POST">
                            <input type = "hidden" name = "task_id" value = "<?= $task['id']?>">
                            <button type = "submit" name = "delete_task" class = "btn btn-danger" onclick = "return confirm('Stergeti task-ul?')">Sterge</button>
                         </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</body>
</html>
