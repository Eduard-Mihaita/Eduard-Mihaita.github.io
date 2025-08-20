<?php
class Task{
    public string $title;
    public string $description;
    public int $assigned_to;
    public string $priority;
    public string $due_date;

    public function __construct(string $title = '', string $description = '', int $assigned_to = 0, string $priority = 'Medie', string $due_date = "null")
    {
        $this->title = $title;
        $this->description = $description;
        $this->assigned_to = $assigned_to;
        $this->priority = $priority;
        $this->due_date = $due_date;
    }
}    
?>