<?php

require_once('../dao/TaskDao.php');
require_once('../models/TaskModel.php');

class TaskController
{
    private $TaskDAO;

    public function __construct() {
        $this->TaskDAO = new TaskDao();
    }

    public function listTasks()
    {        
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($this->TaskDAO->getAllTasks());
    }

    public function getTask($id)
    {        
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($this->TaskDAO->getTask($id));
    }

    public function createTask($task)
    {
        header('Content-Type: application/json');       
        $objTaskModel = new Task($task['name'], $task['status'], $task['description']);             
        if($this->TaskDAO->addTask($objTaskModel)){
            http_response_code(201);
            echo json_encode(['code'=> '1' , 'message' => 'Task added successfully']);
        }else{
            http_response_code(403);
            echo json_encode(['code'=> '0' , 'message' => 'Task added error']);
        }
        
    }

    public function updateTask($id , $task)
    {
        header('Content-Type: application/json');  
        $objTaskModel = new Task($task['name'], $task['status'], $task['description']);        
        if($this->TaskDAO->updateTask( $id ,$objTaskModel)){
            http_response_code(200);
            echo json_encode(['code'=> '1' , 'message' => 'Task updated successfully']);
        }else{
            http_response_code(403);
            echo json_encode(['code'=> '0' , 'message' => 'Task updated error']);
        }
    }  

    public function deleteTask($id)
    {
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($this->TaskDAO->deleteTask($id));  
    }
}
