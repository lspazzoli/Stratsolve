<?php
/**
 * This script is to be used to receive a POST with the object information and then either updates, creates or deletes the task object
 */
require('Task.class.php');
// Assignment: Implement this script
if( $_GET["TaskName"] || $_GET["TaskId"] || $_GET["TaskDescription"] || $_GET["actionStatus"])
{
	debug_to_console( "test" );
	if($_GET["actionStatus"]=="SaveOrUpdate")
	{
		$taskData = file_get_contents('Task_Data.txt');
		$taskArray = json_decode($taskData);
		$isSet = false;
		$tempTask = null;
		foreach ($taskArray as $task) {
			if($task.TaskId == $_GET["TaskId"])
			{
				if($task.TaskDescription != $_GET["TaskDescription"])
				{
					$task.TaskDescription = $_GET["TaskDescription"];
					$isSet = true;
				}
					
				if($task.TaskName != $_GET["TaskName"])
				{
					$task.TaskName = $_GET["TaskName"];
					$isSet = true;
				}
			}	
		}
		
		if($isSet == false)
		{
			$newTask = new Task();
		}
		
	}
	else if($_GET["actionStatus"]=="DeleteRecord")
	{
		foreach ($taskArray as $task) {
			if($task.TaskId == $_GET["TaskId"])
			{
				//$tempTask = 
			}	
		}
	}
}
function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}

?>