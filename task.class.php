<?php
/**
 * This class handles the modification of a task object
 */
class Task {
    public $TaskId;
    public $TaskName;
    public $TaskDescription;
    protected $TaskDataSource;
    public function __construct($Id = null) {
        $this->TaskDataSource = file_get_contents('Task_Data.txt');
        if (strlen($this->TaskDataSource) > 0)
            $this->TaskDataSource = json_decode($this->TaskDataSource); // Should decode to an array of Task objects
        else
            $this->TaskDataSource = array(); // If it does not, then the data source is assumed to be empty and we create an empty array

        if (!$this->TaskDataSource)
            $this->TaskDataSource = array(); // If it does not, then the data source is assumed to be empty and we create an empty array
        if (!$this->LoadFromId($Id))
            $this->Create();
    }
    protected function Create() {
        // This function needs to generate a new unique ID for the task
        // Assignment: Generate unique id for the new task
        $this->TaskId = $this->getUniqueId();
        $this->TaskName = 'New Task';
        $this->TaskDescription = 'New Description';
    }
    protected function getUniqueId() {
        return gmdate('Y-m-d h:i:s \G\M\T'); // VeryUniqueID
    }
    protected function LoadFromId($Id = null) {//Dont know what this is needed for ?
        if ($Id) {
            // Assignment: Code to load details here...
        } else
            return null;
    }

    public function Save($taskArray) {//save done in update.php
        //Assignment: Code to save task here
		$json = json_encode($taskArray);
		file_put_contents('Task_Data.txt', $json);
    }
    public function Delete() {//delete done in update.php
        //Assignment: Code to delete task here
		echo "Del Request";
    }
}
?>