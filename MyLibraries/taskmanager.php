<?php
/* 
 * Author: Nicole Amporn Binette
 * Date: Feb 7th 2019
 * Task Manager Library
 */
    function taskmanager_add_task(&$task_list, &$errors) {
        $new_task = filter_input(INPUT_POST, 'newtask');
        if (empty($new_task)) {
            $errors[] = 'The new task cannot be empty.';
        } else {
            array_push($task_list, $new_task);
        }
    }
    
    function taskmanager_delete_task(&$task_list, &$errors) {
        $task_index = filter_input(INPUT_POST, 'taskid', FILTER_VALIDATE_INT);
        if ($task_index === NULL || $task_index === FALSE) {
            $errors[] = 'The task cannot be deleted.';
        } else {
            unset($task_list[$task_index]);
            $task_list = array_values($task_list);
        }
    }
    
    function taskmanager_modify_task(&$task_list) {
        $task_index = filter_input(INPUT_POST, 'taskid');
        $task_to_modify = $task_list[$task_index];
        return $task_to_modify;
    }
    
    function taskmanager_save_changes(&$task_list, &$errors) {
        $task_index = filter_input(INPUT_POST, 'modifiedtaskid');
        $modified_task = filter_input(INPUT_POST, 'modifiedtask');
        if (empty($modified_task)) {
            $errors[] = 'The modified task cannot be empty.';
        } else {
            $task_list[$task_index] = $modified_task;
        }
    }
    
    function taskmanager_promote_task(&$task_list, &$errors) {
        $task_index = filter_input(INPUT_POST, 'taskid');
        if ($task_index == 0) {
            $errors[] = 'Cannot promote first task.';
        } else {
            $switch_task_index = $task_index - 1;
            $switch_task = $task_list[$switch_task_index];
            $promote_task = $task_list[$task_index];
            $task_list[$switch_task_index] = $promote_task;
            $task_list[$task_index] = $switch_task;
        }
    }
    
    function taskmanager_sort_tasks(&$task_list) {
        array_multisort($task_list);
        
    }


