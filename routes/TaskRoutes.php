<?php
require_once '../controllers/TaskController.php';
$metho = $_SERVER['REQUEST_METHOD'];
$objTaskController = new TaskController();

switch ($metho) {
    case 'POST':
        break;
    case 'GET':
        if (isset($_GET['id']) && !empty($_GET['id'])) {
                $id = $_GET['id'];
                $objTaskController->getTask($id);
        } else {
            return $objTaskController->listTasks();
        }
        break;
    case 'PUT':
        break;
    case 'DELETE':
        break;
    default:

        break;
}
