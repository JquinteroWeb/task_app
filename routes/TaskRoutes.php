<?php
require_once '../controllers/TaskController.php';
$metho = $_SERVER['REQUEST_METHOD'];
$objTaskController = new TaskController();

switch ($metho) {
    case 'POST':
        if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['status'])) {
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);
            $status = trim($_POST['status']);
            $objTaskController->createTask(['name' => $name, 'description' => $description, 'status' => $status]);
        } else {
            header('Content-Type: application/json');
            http_response_code(403);
            echo json_encode(['code' => '0', 'message' => 'Task add error']);
        }
        break;
    case 'GET':
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];
            $objTaskController->getTask($id);
        } else {
            $objTaskController->listTasks();
        }
        break;
    case 'PUT':        
        $putData = file_get_contents("php://input");
        // Verificar si los datos son JSON válidos
        $jsonData = json_decode($putData, true);           

        if(isset($jsonData['name']) && isset($jsonData['description']) && isset($jsonData['status']) && isset($jsonData['id']) ){
            
            $name = trim($jsonData['name']);
            $description = trim($jsonData['description']);
            $status = trim($jsonData['status']);
            $id = trim($jsonData['id']);
            $objTaskController->updateTask( $id , ['name' => $name, 'description' => $description, 'status' => $status]);
        }else {
            header('Content-Type: application/json');
            http_response_code(403);
            echo json_encode(['code' => '0', 'message' => 'Task updated error']);
        }
        break;
    case 'DELETE':
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];
            $objTaskController->deleteTask($id);
        } else {
            header('Content-Type: application/json');
            http_response_code(403);
            echo json_encode(['code' => '0', 'message' => 'You have to provide a task id.']);
        }
        break;
    default:

        break;
}
