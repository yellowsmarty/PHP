<?php
//get tasklist array from POST
$task_list = filter_input(INPUT_POST, 'tasklist', 
        FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
if ($task_list === NULL) {
    $task_list = array();
    
    // add some hard-coded starting values to make testing easier
    $task_list[] = 'Write chapter';
    $task_list[] = 'Edit chapter';
    $task_list[] = 'Proofread chapter';
}

//get action variable from POST
$action = filter_input(INPUT_POST, 'action');

//initialize error messages array
$errors = array();

//set path to library
$include_path = get_include_path();
set_include_path($include_path . ':/Applications/XAMPP/xamppfiles/htdocs/MyLibraries');

//access library
require_once 'taskmanager.php';

//process
switch( $action ) {
    case 'Add Task':
        taskmanager_add_task($task_list, $errors);
        break;
    case 'Delete Task':
        taskmanager_delete_task($task_list, $errors);
        break;

    case 'Modify Task':
        $task_to_modify = taskmanager_modify_task($task_list);
        $task_index = array_search($task_to_modify, $task_list);
        break;
    
    case 'Save Changes':
        taskmanager_save_changes($task_list, $errors);
        break;
    
    case 'Cancel Changes':
        // Do nothing if they don't want to change the element in the array
        break;
    
    case 'Promote Task':
        taskmanager_promote_task($task_list, $errors);
        break;
        
        
    case 'Sort Tasks':
        taskmanager_sort_tasks($task_list);
        break;
    
}

include('task_list.php');
?>