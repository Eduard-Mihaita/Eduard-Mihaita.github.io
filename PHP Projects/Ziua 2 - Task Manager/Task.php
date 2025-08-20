<?php
class Task{
    public string $title;
    public string $description;
    public int $assigned_to;
    public string $assigned_name;
    public string $priority;
    public string $due_date;
    private TaskManager $manager;

    public function __construct(string $title = '', string $description = '', int $assigned_to = 0, string $assigned_name = '', string $priority = 'Medie', string $due_date = "null")
    {
        $this->title = $title;
        $this->description = $description;
        $this->assigned_to = $assigned_to;
        $this->assigned_name = $assigned_name;
        $this->priority = $priority;
        $this->due_date = $due_date;
    }
    public function createTask(){
        return $this->manager->addTask($this->title, $this->description, $this->assigned_to, $this->assigned_name, $this->priority, $this->due_date);
    }
}    
?>