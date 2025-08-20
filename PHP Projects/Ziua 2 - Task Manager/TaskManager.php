<?php
class TaskManager {
    private PDO $db;

    public function __construct() {
        $this->connect();
        $this->createTables();
    }

    // Conectare și creare DB/tabele
    private function connect(): void {
        $this->db = new PDO("sqlite:" . __DIR__ . "/tasks.db");
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    private function createTables(): void {
        $this->db->exec("
            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                email TEXT UNIQUE NOT NULL,
                role TEXT DEFAULT 'developer'
            );
            CREATE TABLE IF NOT EXISTS tasks (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                title TEXT NOT NULL,
                description TEXT,
                assigned_to INTEGER,
                status TEXT DEFAULT 'pending',
                priority TEXT DEFAULT 'medium',
                due_date TEXT,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (assigned_to) REFERENCES users (id)
            );
        ");
    }
    // USERS
    public function addUser(string $name, string $email, string $role = 'developer'): bool {
        $stmt = $this->db->prepare("INSERT INTO users (name, email, role) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $email, $role]);
    }
    public function getUsers(): array {
        $stmt = $this->db->query("SELECT * FROM users ORDER BY name");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // TASKS
    public function addTask(string $title, string $description, int $assignedTo, string $priority = 'medium', string $dueDate = ""): bool {
        $stmt = $this->db->prepare("INSERT INTO tasks (title, description, assigned_to, priority, due_date) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$title, $description, $assignedTo, $priority, $dueDate]);
    }
    public function getTasks(): array {
        $stmt = $this->db->query("
            SELECT t.*, u.name as assigned_name
            FROM tasks t LEFT JOIN users u ON t.assigned_to = u.id
            ORDER BY t.created_at DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function updateTaskStatus(int $taskId, string $status): bool {
        $stmt = $this->db->prepare("UPDATE tasks SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $taskId]);
    }
    public function deleteTask(int $taskId): bool {
        $stmt = $this->db->prepare("DELETE FROM tasks WHERE id = ?");
        return $stmt->execute([$taskId]);
    }
}
?>
