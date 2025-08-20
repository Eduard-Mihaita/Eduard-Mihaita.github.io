<?php
require_once 'TaskManager.php';
$manager = new TaskManager();

// Exemplu pentru inițializare (fără useri): adaugă un user la început
if (empty($manager->getUsers())) {
    $manager->addUser('Edi Elev', 'edi@company.com', 'developer');
}
// Pentru sarcini, folosești $manager->addTask(...) etc.
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
<body>
    <div class = "container py-5">
        <div class = "card mb-2">
            <!-- Form de creat task nou -->
            <h2 class = "text-center mt-2">Task Manager</h2>
            <div class = "card-body">
                <form method = "POST" class = "mb-2" action="Task.php">
                    <label class = "form-label">Titlu</label>
                        <input type = "text" name = "title" class = "form-control" required></input>
                    <label class = "form-label">Descriere</label>
                        <textarea name = "description" class="form-control" rows = "2" required></textarea>
                    <label class = "form-label">Atribuit catre</label>
                        <select name = "assigned_to" class = "form-control" required>
                            <option value = "">Selectati utilizatorul</option>
                            <?php foreach ($users as $user): ?>
                                <option value="<?= $user['id'] ?>"><?= htmlspecialchars($user['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    <label class = "form-label">Prioritate</label>
                        <select name = "priority" class = "form-select" required>
                            <option value = "Low">Scazuta</option>
                            <option value = "Medium">Medie</option>
                            <option value = "High">Ridicata</option>
                        </select>
                    <label class = "form-label">Deadline</label>
                        <input type = "date" name = "due_date"  class = "form-control" required></input>
                    <button type = "submit" name = "add_task" class = "btn btn-primary mt-2">Adauga Task</button>
                </form>
            </div>
        </div>
        <div class = "card mb-2">
            <!-- Form de creat user nou -->
            <h2 class = "text-center mt-2" >Adauga User Nou</h2>
            <div class = "card-body">
                <form method = "POST" class = "mb-2" action="User.php">
                        <label class = "form-label">Nume:</label>
                            <input type = "text" name = "name" class = "form-control" required>
                        <label class = "form-label">Email:</label>
                            <input type = "email" name = "email" class = "form-control" required>
                        <label class = "form-label">Rol:</label>
                            <select name = "role" class = "form-control" required>
                                <option value = "developer">Developer</option>
                                <option value = "manager">Manager</option>
                                <option value = "tester">Tester</option>
                                <option value = "designer">Designer</option>
                            </select>
                    <button type = "submit" name = "add_user" class = "btn btn-primary mt-2">Adauga User</button>
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
                         <form method = "POST" action="Task.php">
                            <input type = "hidden" name = "task_id" value = "<?= $task['id']?>">
                            <button type = "submit" name = "delete_task" class = "btn btn-danger" onclick = "return confirm('Stergeti task-ul?')">Sterge</button>
                         </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div></div>
</body>
</html>
