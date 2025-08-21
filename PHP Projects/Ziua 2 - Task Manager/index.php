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
    <div class="container-fluid">
        <h1 class="text-center mt-2">Task Manager</h1>
        <div class="row pt-3">
            <div class="col-md-8">
                <!-- Form de creat task nou -->
                 <div class="card mb-2">
                    <h2 class = "text-center mt-2">Adaugă Task</h2>
                    <div class = "card-body">
                    <form method = "POST" class = "mb-2" action="Task.php">
                        <label class = "form-label">Titlu:</label>
                            <input type = "text" name = "title" class = "form-control" required></input>
                        <label class = "form-label">Descriere:</label>
                            <textarea name = "description" class="form-control" rows = "2" required></textarea>
                        <label class = "form-label">Atribuit către:</label>
                            <select name = "assigned_to" class = "form-control" required>
                                <option value = "">Selectați utilizatorul</option>
                                <?php foreach ($users as $user): ?>
                                    <option value="<?= $user['id'] ?>"><?= htmlspecialchars($user['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        <label class = "form-label">Prioritate:</label>
                            <select name = "priority" class = "form-select" required>
                                <option value = "Scăzută">Scăzută</option>
                                <option value = "Medie">Medie</option>
                                <option value = "Ridicată">Ridicată</option>
                            </select>
                        <label class = "form-label">Deadline:</label>
                            <input type = "date" name = "due_date"  class = "form-control" required></input>
                        <button type = "submit" name = "add_task" class = "btn btn-primary mt-2">Adauga Task</button>
                    </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <!-- Form de creat user nou -->
                 <div class="card mb-2">
                    <h2 class = "text-center mt-2" >Adaugă User Nou</h2>
                    <div class="card-body">
                        <form method = "POST" class = "mb-2" action="User.php">
                            <label class = "form-label">Nume:</label>
                                <input type = "text" name = "name" class = "form-control" required>
                            <label class = "form-label">Email:</label>
                                <input type = "email" name = "email" class = "form-control" required>
                            <label class = "form-label">Rol:</label>
                                <select name = "role" class = "form-control" required>
                                    <option value = "Developer">Developer</option>
                                    <option value = "Manager">Manager</option>
                                    <option value = "Tester">Tester</option>
                                    <option value = "Designer">Designer</option>
                                </select>
                        <button type = "submit" name = "add_user" class = "btn btn-primary mt-2">Adauga User</button>
                    </form>
                    </div>
                 </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <!-- Lista taskuri -->
                 <div class="card">
                    <div class="card-body">
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
                                        <td><?= htmlspecialchars($task['status']) ?>
                                            <form method="POST" action="Task.php">
                                                <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                                                <select name="status" class="form-select-sm" onchange="this.form.submit()">
                                                    <option value="Pending" <?= $task['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                                    <option value="In progress" <?= $task['status'] == 'In progress' ? 'selected' : '' ?>>In Progress</option>
                                                    <option value="Completed" <?= $task['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
                                                    <option value="Cancelled" <?= $task['status'] == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                                </select>
                                                <input type="hidden" name="update_task" value="1"> 
                                            </form>
                                        </td>
                                        <td><?= htmlspecialchars($task['priority']) ?></td>
                                        <td><?= htmlspecialchars($task['due_date']) ?></td>
                                        <td>
                                            <!-- Aici adaugi butoane pentru update/delete status (apelezi metodele deja scrise) -->
                                            <form method = "POST" action="Task.php">
                                                <input type = "hidden" name = "task_id" value = "<?= $task['id']?>">
                                                <button type = "submit" name = "delete_task" class = "btn btn-danger" onclick = "return confirm('Ștergeți task-ul?')">Șterge task</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                 </div>
            </div>
            <div class="col-md-4">
                <!-- Lista useri -->
                 <div class="card">
                    <div class="card-body">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>Nume</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($user['name']) ?></td>
                                        <td><?= htmlspecialchars($user['email']) ?></td>
                                        <td><?= htmlspecialchars($user['role']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</body>
</html>
