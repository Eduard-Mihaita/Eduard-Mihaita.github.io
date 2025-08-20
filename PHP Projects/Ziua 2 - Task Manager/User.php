<?php
require_once 'TaskManager.php';
class User{
    public string $name;
    public string $email;
    public string $role;
    private TaskManager $taskManager;

    public function __construct(string $name, string $email, string $role = 'developer') 
    {
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
        $this->taskManager = new TaskManager();
    }

    public function save(): bool {
        return $this->taskManager->addUser($this->name, $this->email, $this->role);
    }
}
if ($_POST && isset($_POST['add_user'])) {
    $user = new User(
        $_POST['name'],
        $_POST['email'],
        $_POST['role']
    );
}
if ($user->save()) {
    header('Location: index.php');
    exit;
}
?>