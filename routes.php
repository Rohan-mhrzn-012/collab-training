<?php
include __DIR__ . "/controllers/ProjectController.php";

$route = $_GET["route"] ?? null;
$action = $_GET["action"] ?? null;

$project_obj = new ProjectController;

if ($route === "project") {
    switch ($action) {
        case "create":
            $project_obj->create();
            break;
        case "edit":
            $project_obj->edit();
            break;
        case "view":
            $project_obj->view();
            break;
        case "delete":
            $project_obj->view();
            break;
    }
}
