<?php

 include ("task.class.php");
/**
 * This script is to be used to receive a POST with the object information and then either updates, creates or deletes the task object
 
 // Assignment: Implement this script
 */
$task=new Task();
if( $_REQUEST["TaskName"] || $_REQUEST["TaskId"] || $_REQUEST["TaskDescription"] || $_REQUEST["actionStatus"])
{
	$TaskDataSource = file_get_contents('Task_Data.txt');
	$taskArray = json_decode($TaskDataSource);
	if($_REQUEST["actionStatus"]=="SaveOrUpdate")
	{
		
		$isSet = false;
		foreach ($taskArray as $task) {
				if($task->TaskId == $_REQUEST["TaskId"])//update
					{$isSet = true;//If the task exists
						if($task->TaskDescription != $_REQUEST["TaskDescription"])
						{
							$task->TaskDescription = $_REQUEST["TaskDescription"];
						}if($task->TaskName != $_REQUEST["TaskName"])
						{
							$task->TaskName = $_REQUEST["TaskName"];
						}
					}
			}if ($isSet==false)
			{ 
				 
				 $input->TaskId=gmdate('Y-m-d h:i:s \G\M\T');//add;
				 $input->TaskName=$_REQUEST["TaskName"];
				 $input->TaskDescription=$_REQUEST["TaskDescription"];
				 array_push($taskArray,$input);
			}
			
	}
	else if($_REQUEST["actionStatus"]=="DeleteRecord")//Delete
		{$x=0;
			foreach ($taskArray as $task) {
				if($task->TaskId == $_REQUEST["TaskId"])
				{
					array_splice($taskArray, $x, 1);//Remove from array
				}	$x=$x+1;
			}
			$taskArray = array_values($taskArray);
		}
		
		$json = json_encode($taskArray);//Save
		file_put_contents('Task_Data.txt', $json);
}
?>