<?php
include_once '../config/Database.php';
class TaskDao
{
    private $db;
    private $con;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->con = $this->db->getConnection();
    }

    public function getAllTasks()
    {
        $query = "SELECT * FROM task";
        $stmt = $this->con->query($query);
        $tasks = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tasks[] = $row;
        }
        return $tasks;
    }

    public function getTask($id)
    {
        try {
            $query = 'SELECT * FROM task WHERE "UID_TASK" = :id';
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $tasks = [];

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $tasks[] = $row;
                }

                return $tasks;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            return null;
        }
    }
    public function addTask($task)
    {
        try {
            $name = $task->getName();
            $status = $task->getStatus();
            $desc = $task->getDescription();
            $query = 'INSERT INTO task ("NAME_TASK", "STATUS_TASK", "DESC_TASK", "DATE_CREATED_TASK") VALUES (:name, :status, :desc, NOW())';
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_BOOL);
            $stmt->bindParam(':desc', $desc, PDO::PARAM_STR);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error al agregar la tarea: " . $e->getMessage();
            return false;
        }
    }


    public function deleteTask($id)
    {
        $query = 'DELETE FROM task WHERE "UID_TASK" = :id';
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateTask( $id, $task){
        $name = $task->getName();
        $status = $task->getStatus();
        $desc = $task->getDescription();
        $query = 'UPDATE task SET "NAME_TASK" = :name, "STATUS_TASK" = :status, "DESC_TASK" = :desc WHERE "UID_TASK" = :id';
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_BOOL);
        $stmt->bindParam(':desc', $desc, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }



    // Puedes agregar métodos adicionales aquí, como insertar, actualizar o eliminar tareas
}
