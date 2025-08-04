<?php
session_start();
include_once __DIR__ . "/controllers/ProjectController.php";
include_once __DIR__ . "/controllers/SkillController.php";
include_once __DIR__ . "/controllers/ExperienceController.php";

$route = $_GET["route"] ?? null;
$action = $_GET["action"] ?? null;

$project_obj = new ProjectController;
$skill_obj = new SkillController;
$exp_obj = new ExperienceController;

if ($route === "project") {
    switch ($action) {
        case "create":
            $project_obj->create();
            break;
        case "edit":
            $project_obj->edit();
            break;
        // case "view":
        //     $project_obj->view();
        //     break;
        case "delete":
            $project_obj->delete();
            break;
    }
}

if($route === "skills"){
    switch($action){
        case "create":
            $skill_obj->create();
            break;
        case "edit":
            $skill_obj->edit();
            break;
        case "delete":
            $skill_obj->delete();
            break;
    }

}


if($route === "experience"){
    switch($action){
        case "create":
            $exp_obj->create();
            break;
        case "edit":
            $exp_obj->edit();
            break;
        case "delete":
            $exp_obj->delete();
            break;
    }

}