<?php
include_once '../config/Database.php';
include_once '../models/TaskModel.php';

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

            $task = new Task(
                $row['UID_TASK'],
                $row['NAME_TASK'],
                $row['STATUS_TASK'],
                $row['DESC_TASK'],
                $row['DATE_CREATED_TASK']
            );

            $tasks[] = $task->jsonSerialize();
        }

        return $tasks;
    }

    public function getTask($id)
    {
        try {
            $query = "SELECT * FROM task WHERE UID_TASK = :id";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $tasks = [];

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $task = new Task(
                        $row['UID_TASK'],
                        $row['NAME_TASK'],
                        $row['STATUS_TASK'],
                        $row['DESC_TASK'],
                        $row['DATE_CREATED_TASK']
                    );
                    $tasks[] = $task->jsonSerialize();
                }

                return $tasks;
            } else {
                // Hubo un error en la consulta
                return null;
            }
        } catch (PDOException $e) {
            // Manejo de errores de base de datos
            // Puedes registrar el error o lanzar una excepción si es necesario
            return null;
        }
    }


    public function deleteTask($id)
    {
        $query = "DELETE FROM task WHERE UID_TASK = :id";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }



    // Puedes agregar métodos adicionales aquí, como insertar, actualizar o eliminar tareas
}
