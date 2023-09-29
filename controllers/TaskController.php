<?php

require_once ('../dao/TaskDao.php');

class TaskController
{
    public function listTasks()
    {
        $objTaskDao = new TaskDao();
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($objTaskDao->getAllTasks());
    }

    public function getTask($id){
        $objTaskDao = new TaskDao();
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($objTaskDao->getTask($id));

    }

    public function createTask()
    {

    }

    public function editTask($taskId)
    {
    }

    public function completeTask($taskId)
    {
    }

    public function deleteTask($taskId)
    {
    }
}
